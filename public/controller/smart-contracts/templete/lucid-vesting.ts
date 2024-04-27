import {
  Data,
  Lucid,
  Blockfrost,
  getAddressDetails,
  SpendingValidator,
  TxHash,
  Datum,
  UTxO,
  Address,
  AddressDetails,
} from "https://deno.land/x/lucid@0.9.1/mod.ts"
// create a seed.ts file with your seed
import { secretSeed } from "./seed.ts"

// set blockfrost endpoint
const lucid = await Lucid.new(
new Blockfrost(
  "https://cardano-preprod.blockfrost.io/api/v0",
  "{{blockfrost_api_key}}"
),
"Preprod"
);

// load local stored seed as a wallet into lucid
lucid.selectWalletFromSeed(secretSeed);
const addr: Address = await lucid.wallet.address();
console.log(addr);

// Define the vesting plutus script
const vestingScript: SpendingValidator = {
  type: "PlutusV2",
  script: "<insert-policy-address-here",
};
const vestingAddress: Address = lucid.utils.validatorToAddress(vestingScript);

// Create the vesting datum type
const VestingDatum = Data.Object({
  beneficiary: Data.String,
  deadline: Data.BigInt,
});
type VestingDatum = Data.Static<typeof VestingDatum>;

// Set the vesting deadline
const deadlineDate: Date = new Date("{{vesting_deadline}}")
const deadlinePosIx = BigInt(deadlineDate.getTime());

// Set the vesting beneficiary to our own key.
const details: AddressDetails = getAddressDetails(addr);
const beneficiaryPKH: string = details.paymentCredential.hash

// Creating a datum with a beneficiary and deadline
const datum: VestingDatum = {
  beneficiary: beneficiaryPKH,
  deadline: deadlinePosIx,
};

// An asynchronous function that sends an amount of Lovelace to the script with the above datum.
async function vestFunds(amount: bigint): Promise<TxHash> {
  const dtm: Datum = Data.to<VestingDatum>(datum,VestingDatum);
  const tx = await lucid
    .newTx()
    .payToContract(vestingAddress, { inline: dtm }, { lovelace: amount })
    .complete();
  const signedTx = await tx.sign().complete();
  const txHash = await signedTx.submit();
  return txHash
}

async function claimVestedFunds(): Promise<TxHash> {
  const dtm: Datum = Data.to<VestingDatum>(datum,VestingDatum);
  const utxoAtScript: UTxO[] = await lucid.utxosAt(vestingAddress);
  const ourUTxO: UTxO[] = utxoAtScript.filter((utxo) => utxo.datum == dtm);
  
  if (ourUTxO && ourUTxO.length > 0) {
      const tx = await lucid
          .newTx()
          .collectFrom(ourUTxO, Data.void())
          .addSignerKey(beneficiaryPKH)
          .attachSpendingValidator(vestingScript)
          .validFrom(Date.now()-100000)
          .complete();

      const signedTx = await tx.sign().complete();
      const txHash = await signedTx.submit();
      return txHash
  }
  else return "No UTxO's found that can be claimed"
}

//console.log(await vestFunds(100000000n));
//console.log(await claimVestedFunds());