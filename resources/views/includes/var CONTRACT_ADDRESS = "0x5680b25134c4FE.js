var CONTRACT_ADDRESS = "0x5680b25134c4FE2300616848E072180AC562CB28"; // ICO address
var ABI = [{
    "inputs": [{
        "internalType": "address payable",
        "name": "marketingAddr",
        "type": "address"
    }, {
        "internalType": "address payable",
        "name": "_GenerationWallet",
        "type": "address"
    }, {
        "internalType": "address payable",
        "name": "_projectAddress",
        "type": "address"
    }, {
        "internalType": "contract IBEP20",
        "name": "tokenAdd",
        "type": "address"
    }],
    "stateMutability": "nonpayable",
    "type": "constructor"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "user",
        "type": "address"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "totalAmount",
        "type": "uint256"
    }],
    "name": "FeePayed",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "user",
        "type": "address"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "NewDeposit",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": false,
        "internalType": "address",
        "name": "user",
        "type": "address"
    }],
    "name": "Newbie",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "referrer",
        "type": "address"
    }, {
        "indexed": true,
        "internalType": "address",
        "name": "referral",
        "type": "address"
    }, {
        "indexed": true,
        "internalType": "uint256",
        "name": "level",
        "type": "uint256"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "RefBonus",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "user",
        "type": "address"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "Withdrawn",
    "type": "event"
}, {
    "inputs": [],
    "name": "BASE_PERCENT",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "BepSegment",
    "outputs": [{
        "internalType": "address payable",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "name": "GI_PERCENT",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "GenerationWallet",
    "outputs": [{
        "internalType": "address payable",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "INVEST_MIN_AMOUNT",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "LAUNCH_TIME",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "PERCENTS_DIVIDER",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "TIME_STEP",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getAvailable",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "getChainID",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "pure",
    "type": "function"
}, {
    "inputs": [],
    "name": "getContractBalance",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getTimer",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserAmountOfDeposits",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserAmountOfReferrals",
    "outputs": [{
        "internalType": "uint256[]",
        "name": "structure",
        "type": "uint256[]"
    }, {
        "internalType": "uint256[]",
        "name": "levelBusiness",
        "type": "uint256[]"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserAvailable",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserCheckpoint",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "index",
        "type": "uint256"
    }],
    "name": "getUserDepositInfo",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserDividends",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserReferralBonus",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserReferrer",
    "outputs": [{
        "internalType": "address",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserTotalDeposits",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "userAddress",
        "type": "address"
    }],
    "name": "getUserTotalWithdrawn",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address payable",
        "name": "referrer",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "token_quantity",
        "type": "uint256"
    }],
    "name": "invest",
    "outputs": [],
    "stateMutability": "payable",
    "type": "function"
}, {
    "inputs": [],
    "name": "marketingAddress",
    "outputs": [{
        "internalType": "address payable",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "projectAddress",
    "outputs": [{
        "internalType": "address payable",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "token",
    "outputs": [{
        "internalType": "contract IBEP20",
        "name": "",
        "type": "address"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "totalDeposits",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "totalInvested",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "totalWithdrawn",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [{
        "internalType": "address",
        "name": "",
        "type": "address"
    }],
    "name": "users",
    "outputs": [{
        "internalType": "uint256",
        "name": "checkpoint",
        "type": "uint256"
    }, {
        "internalType": "address payable",
        "name": "referrer",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "direct_amount",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "gi_bonus",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "total_gi_bonus",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "id",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "available",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "withdrawn",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "total_direct_bonus",
        "type": "uint256"
    }, {
        "internalType": "uint256",
        "name": "total_invested",
        "type": "uint256"
    }],
    "stateMutability": "view",
    "type": "function"
}, {
    "inputs": [],
    "name": "withdraw",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
}];

var TOKEN_ADRESS = "0x55d398326f99059ff775485246999027b3197955"; //  USDT BEP20 Address
var ABITOKEN = [{
    "inputs": [],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "constructor"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "owner",
        "type": "address"
    }, {
        "indexed": true,
        "internalType": "address",
        "name": "spender",
        "type": "address"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "value",
        "type": "uint256"
    }],
    "name": "Approval",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "previousOwner",
        "type": "address"
    }, {
        "indexed": true,
        "internalType": "address",
        "name": "newOwner",
        "type": "address"
    }],
    "name": "OwnershipTransferred",
    "type": "event"
}, {
    "anonymous": false,
    "inputs": [{
        "indexed": true,
        "internalType": "address",
        "name": "from",
        "type": "address"
    }, {
        "indexed": true,
        "internalType": "address",
        "name": "to",
        "type": "address"
    }, {
        "indexed": false,
        "internalType": "uint256",
        "name": "value",
        "type": "uint256"
    }],
    "name": "Transfer",
    "type": "event"
}, {
    "constant": true,
    "inputs": [],
    "name": "_decimals",
    "outputs": [{
        "internalType": "uint8",
        "name": "",
        "type": "uint8"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "_name",
    "outputs": [{
        "internalType": "string",
        "name": "",
        "type": "string"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "_symbol",
    "outputs": [{
        "internalType": "string",
        "name": "",
        "type": "string"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": true,
    "inputs": [{
        "internalType": "address",
        "name": "owner",
        "type": "address"
    }, {
        "internalType": "address",
        "name": "spender",
        "type": "address"
    }],
    "name": "allowance",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "spender",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "approve",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": true,
    "inputs": [{
        "internalType": "address",
        "name": "account",
        "type": "address"
    }],
    "name": "balanceOf",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "burn",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "decimals",
    "outputs": [{
        "internalType": "uint8",
        "name": "",
        "type": "uint8"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "spender",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "subtractedValue",
        "type": "uint256"
    }],
    "name": "decreaseAllowance",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "getOwner",
    "outputs": [{
        "internalType": "address",
        "name": "",
        "type": "address"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "spender",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "addedValue",
        "type": "uint256"
    }],
    "name": "increaseAllowance",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "mint",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "name",
    "outputs": [{
        "internalType": "string",
        "name": "",
        "type": "string"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "owner",
    "outputs": [{
        "internalType": "address",
        "name": "",
        "type": "address"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [],
    "name": "renounceOwnership",
    "outputs": [],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "symbol",
    "outputs": [{
        "internalType": "string",
        "name": "",
        "type": "string"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": true,
    "inputs": [],
    "name": "totalSupply",
    "outputs": [{
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
    }],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "recipient",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "transfer",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "sender",
        "type": "address"
    }, {
        "internalType": "address",
        "name": "recipient",
        "type": "address"
    }, {
        "internalType": "uint256",
        "name": "amount",
        "type": "uint256"
    }],
    "name": "transferFrom",
    "outputs": [{
        "internalType": "bool",
        "name": "",
        "type": "bool"
    }],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}, {
    "constant": false,
    "inputs": [{
        "internalType": "address",
        "name": "newOwner",
        "type": "address"
    }],
    "name": "transferOwnership",
    "outputs": [],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
}];

var referrer = '0xbA19734AC6DB7d09D11FE5809D0800681F3Af1b8'

var currentAddr;
var contract = null;

var gasPrice = '7000000000';

var upline = '0xbA19734AC6DB7d09D11FE5809D0800681F3Af1b8'


var user_available = 0





window.addEventListener('load', Connect)


async function Connect() {
    //test();

    console.log('connect function calling');


    if (window.ethereum) {
        window.web3 = new Web3(ethereum)
        try {
            await ethereum.enable()
            let accounts = await web3.eth.getAccounts()
            //const accounts = await ethereum.request({ method: 'eth_accounts' });
            currentAddr = accounts[0]




            console.log('current address', currentAddr);
            console.log('metamask connected');

            contract = await new web3.eth.Contract(ABI, CONTRACT_ADDRESS);
            tokenContract = await new web3.eth.Contract(ABITOKEN, TOKEN_ADRESS);
            $('#connect_btn').text(getsubstring(currentAddr));

            runAPP()
            return
        } catch (error) {
            console.error(error)
        }
    } else if (window.web3) {
        window.web3 = new Web3(web3.currentProvider)
        let accounts = await web3.eth.getAccounts()
        currentAddr = accounts[0]
        console.log(contract)

        contract = await new web3.eth.Contract(ABI, CONTRACT_ADDRESS);
        tokenContract = await new web3.eth.Contract(ABITOKEN, TOKEN_ADRESS);

        $('#connect_btn').text(getsubstring(currentAddr));
        console.log('wallet connected');
        runAPP()
        return
    }
    setTimeout(checkForBinanceChain, 1500)
}
async function checkForBinanceChain() {
    try {
        await window.BinanceChain.enable()
        console.log(typeof (window.BinanceChain))
        if (window.BinanceChain) {
            console.log('BinanceChain')
            await BinanceChain.enable()
            window.web3 = new Web3(window.BinanceChain)
            let accounts = await web3.eth.getAccounts()
            currentAddr = accounts[0];

            contract = await new web3.eth.Contract(ABI, CONTRACT_ADDRESS);
            tokenContract = await new web3.eth.Contract(ABITOKEN, TOKEN_ADRESS);

            $('#connect_btn').text(getsubstring(currentAddr));
            console.log('wallet connected2');
            console.log(contract)

            runAPP()
            return
        }
    } catch (e) {}
}

async function runAPP() {

    let networkID = await web3.eth.net.getId();
    console.log('network id', networkID);
    if (networkID == 56) {
        //if (networkID == 97) {

        if (!contract) {
            contract = await new web3.eth.Contract(ABI, CONTRACT_ADDRESS)
        }
        if (!tokenContract) {
            tokenContract = await new web3.eth.Contract(ABITOKEN, TOKEN_ADRESS);
        }

        console.log('contract running', contract);



    }

}





setTimeout(function () {

    $('#connect_btn').text(getsubstring(currentAddr));
    console.log('current Addrcurrent Addr', currentAddr);
    $("#ref-link").val('https://www.galactics.co' + '/?ref=' + currentAddr);


    // contract.methods.getContractBalance().call().then(function(r) {
    //     $("#total-balance").html(formatresponse(r))
    // })

    console.log('reading contract function', contract);

    //contract.methods.totalInvested().call().then(function(r) {
    //   $("#total_invested_global").html(formatresponse(r).toFixed(2))
    // })




    contract.methods.getUserTotalDeposits(currentAddr).call().then(function (r) {
        console.log('usrs total-invested', r);
        $("#total-invested").text(r)

    })
    contract.methods.getAvailable(currentAddr).call().then(function (r) {
        console.log('usrs getAvailable', r);
        $("#total-available").text(r);



    })

    contract.methods.getUserDividends(currentAddr).call().then(function (r) {
        $("#user-available").text(r);
        $("#user-available1").text(r);
        contract.methods.users(currentAddr).call().then(function (res) {

            //$('#total_avail').text(formatresponse(parseInt(r)) + formatresponse(parseInt(res.direct_amount)) + //formatresponse(parseInt(res.gi_bonus)));

            $('#total_avail').text(parseFloat(r) + parseFloat(res.direct_amount) + parseFloat(res.gi_bonus));

        })

    })

    contract.methods.users(currentAddr).call().then(function (r) {
        console.log('users all details', r);
        console.log('usrs mapping response', r);
        $("#gi_bonus").html(r.gi_bonus);

        $("#total-invested").html(r.total_invested);
        console.log('total_direct_bonus', total_direct_bonus);


        $("#total_direct_bonus").html(r.total_direct_bonus);

        $("#total_gi_bonus").html(r.total_gi_bonus);

        $('#direct_bonus').val(r.direct_amount);

        // console.log('reward_earned',r.reward_earned);

        // $('#reward_earned').html(formatresponse(r.reward_earned).toFixed(2));



        console.log('direct_amount', r.direct_amount);

        $('#direct_bonus_avail').html(r.direct_amount);
        // $('#reward_available').text(formatresponse(r.reward_available).toFixed(2));


    })
    // contract.methods.totalUsers().call().then(function(r) {
    //     $("#total-users").html(r)
    //     $("#calculate-users-input").val(r)
    // })
    contract.methods.getUserTotalWithdrawn(currentAddr).call().then(function (r) {
        $("#total-withdrawn").html(r)
    })
    // contract.methods.getUserLimit(currentAddr).call().then(function(r) {
    //     $("#total-limit").html(formatresponse(r))
    // })


    contract.methods.getUserReferralBonus(currentAddr).call().then(function (r) {
        console.log('referral bonuses', r);
        $("#bonus").text(r[0]);
        $("#direct_bonus").text(r[1]);
    })
    // console.log('line 113');
    contract.methods.getUserAmountOfReferrals(currentAddr).call().then(function (r) {

        console.log('level heads and business', r);

        for (i = 0; i < r.structure.length; i++) {
            $('#ref_' + i).text(r.structure[i]);
            $('#lb_' + i).text(r.levelBusiness[i]);
        }
    })

    contract.methods.getUserAmountOfReferrals(currentAddr).call().then(function (r) {

        console.log('level heads and business', r);

        for (i = 0; i < r.structure.length; i++) {
            $('#ref_' + i).text(r.structure[i]);
            $('#lb_' + i).text(r.levelBusiness[i]);
        }
    })


    // contract.methods.getrewardinfo(currentAddr).call().then(function(r) {



    //      for(i = 0 ; i < r.length; i++)
    //      {
    //         if(r[i] == true)
    //         {
    //          $('#rew_' + i).text('Achieved');
    //         }
    //         else{
    //             $('#rew_' + i).text('Not achieved');
    //         }

    //      }
    // })


    contract.methods.getUserReferrer(currentAddr).call().then(function (r) {

        console.log('upline address', [...r.split('').slice(0, 8), '...', ...r.split('').slice(42 - 6)].join(''));
        if (r != 0x0000000000000000000000000000000000000000) {
            $("#upline-address").text([...r.split('').slice(0, 8), '...', ...r.split('').slice(42 - 6)].join(''))
        } else {
            $("#upline-address").text("-")
        }
    })
    contract.methods.getUserAmountOfDeposits(currentAddr).call().then(function (r) {
        let amount = r

        console.log('amount', amount);
        let content = ''
        if (amount > 0) {
            contract.methods.getUserDepositInfo(currentAddr, amount - 1).call().then(function (res) {
                let depAmount = res[0]
                let startTime = res[1]
                let readableTime = getTime(startTime)


                console.log('typeof', typeof (depAmount), depAmount);
                if (depAmount != 0) {

                    content += `<tr><td>${readableTime}</td><td>${depAmount} USDT</td></tr>`
                    $("#user-deposits").html(content)
                }
            })
        }

    })
}, 5000)










function invest(input) {
    //  alert(input);
    //  return false;

    if (input < 300) {
        alert('Min Investment id of 300  USDT');
        return;
    }

    var tokens = parseInt(input * 1e18);
    //   console.log('input',tokens);
    //   console.log('type of tokens',typeof(tokens));

    console.log('tokanContracrt', tokenContract);
    console.log('current address', currentAddr);
    console.log('contract address', CONTRACT_ADDRESS);
    //tokenContract.methods.decimals().call().then(res=>{ console.log('big boom');})
    tokenContract.methods.allowance(currentAddr, CONTRACT_ADDRESS).call().then(res => {


        var tokens = parseInt(input * 1e18);
        //   console.log('res',res);
        //   console.log('tokens inside allowance',tokens);
        //console.log('type of res',typeof(parseInt(res)));
        if (parseInt(res) < tokens) {
            console.log('res < tokens block', tokens);
            // input = parseInt(input);
            var tokensapv = web3.utils.toWei((input * 100000).toString(), 'ether');
            // var tokensapv = web3.utils.toWei((input * 100000).toString(), 'ether');
            //var tokensapv = (tokens * 1000000000).toString();
            console.log('line 441', tokensapv);
            tokenContract.methods.approve(CONTRACT_ADDRESS, tokensapv).send({
                value: 0,
                from: currentAddr
            }).then(res => {
                //   showAlert('Your Token is approved, Now you can Invest by clicking Invest now button','success');
                console.log('response of approve function', res);

                var token_to_invest = parseInt(input);
                console.log('token_to_invest', token_to_invest);
                contract.methods.invest(upline, token_to_invest).send({
                    value: 0,
                    from: currentAddr
                }).then(res => {

                    console.log('response of invest function', res);
                    alert('Investment successfull', 'success');

                    window.location.reload();
                })

            })
        } else {
            //console.log('in else block');  
            try {
                if (contract) {

                    var token_to_invest = parseInt(input);
                    console.log('token_to_invest', token_to_invest);
                    contract.methods.invest(upline, token_to_invest).send({
                        value: 0,
                        from: currentAddr
                    }).then(res => {

                        console.log('response of invest function', res);
                        alert('Investment successfull');
                        window.location.reload();
                        //   showAlert('Investment successfull','success');
                    })
                    //console.log('transaction seems successfull');

                }
            } catch (error) {
                console.log('catch error', error);
            }
        }
    })
}


$("#wdbtn").click(function () {

    contract.methods.withdraw().send({
        from: currentAddr
    }).then(function (r) {

        alert('Withdrawal succesfull');
        window.location.reload();
        console.log('withdraw response', r);
    })





})


function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
    //showAlert('Successfuly copied', 'success')

    Swal.fire({
        icon: 'success',
        text: 'Succesfully copied',
    })
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
var refurl = getUrlParameter('ref');
if (refurl) {
    localStorage.setItem('ref', refurl);
}

upline = localStorage.getItem('ref') ? localStorage.getItem('ref') : referrer;


function getTime(time) {
    let date = new Date(time * 1000)
    let month = date.getMonth() + 1
    let day = date.getDate()
    let hours = date.getHours()
    let minutes = date.getMinutes()
    if (month < 10) month = '0' + month
    if (minutes < 10) minutes = '0' + minutes
    if (day < 10) day = '0' + day
    if (hours < 10) hours = '0' + hours
    return (`${day}.${month} | ${hours}:${minutes}`)
}

function unixToReadable(time) {
    let now = new Date()
    let diff = time * 1000 - now.getTime()
    if (diff > 0) {
        let delta = Math.abs(diff) / 1000
        let days = Math.floor(delta / 86400)
        delta -= days * 86400
        let hours = Math.floor(delta / 3600) % 24
        delta -= hours * 3600
        let minutes = Math.floor(delta / 60) % 60
        delta -= minutes * 60
        let seconds = (delta % 60).toFixed(0)
        if (hours < 10) {
            hours = '0' + hours
        }
        if (minutes < 10) {
            minutes = '0' + minutes
        }
        if (seconds < 10) {
            seconds = '0' + seconds
        }
        return (`${hours}:${minutes}:${seconds}`)
    } else {
        return ("00:00:00")
    }
}

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min
}

function getsubstring(str) {
    if (typeof str !== 'string') return '';
    return str.length > 8 ?
        str.substring(0, 4) + '...' + str.substring(str.length - 4) :
        str;
}
