<?php 
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once ("../authentication/check.php");

}


function sp_autoloader($class) {
  include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = 13;
$header_photo = "header_photo";
    
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sharepage NFT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <?php include('../component/f_links.php');?>
      <!-- owl carousel -->
      <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
      
      <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
      <!--NOTIFICATION-->
      <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
      <!-- this script for slider art -->
      <script>
        $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
        loop: true,
        autoPlay: true,
        responsiveClass: true,
        responsive: {
        0: {
        items: 1,
        nav: false
        },
        600: {
        items: 3,
        nav: false
        },
        1000: {
        items: 4,
        nav: false
        }
        }
        });
        });    
      </script>
      <!-- Magnific Popup core CSS file -->
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
      <!-- Magnific Popup core JS file -->
      
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        
  <style type="text/css">
    .page{
      min-height: 400px;
    }

    .nft_image{
      width: 100%;
    }
    .NFT{
      border: 1px solid silver;
      padding: 10px;
      margin-top: 10px;
    }
    .NFT_IMAGE{
      height: 150px;
      overflow: hidden;
    }

    .form_image{
      height: 200px;
      width: 200px;
      object-fit: contain;
    }
  </style>

</head>
<body>

<div id="vue_app">

  

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"  v-on:click="page='market'">NFT MARKETPLACE</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#" v-on:click="page='market'">Marketplace</a></li>
	        <li><a href="#" v-on:click="page='create'">Craete NFT</a></li>
	        <li><a disabled href="#">Dashboard</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
          <li><a href="#" v-show="!wallet_connected" id="btn-connect"><span class="glyphicon glyphicon-user"></span> Connect</a></li>
	        <li><a href="#" v-show="wallet_connected" id="btn-disconnect" ><span class="glyphicon glyphicon-log-in"></span> Disconnect</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

  <div class="container">
    <div v-if="!wallet_connected" class="alert alert-danger">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Wallet is not connected</strong> Connect a wallet first
    </div>
    <div v-if="wallet_connected" class="alert alert-success">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Wallet connected !</strong> <p>{{wallet_address}}</p>
    </div>
  </div>

  
  <!-------------------------------------------------------->
  <div class="page"  v-if="page=='market'" >
     
      <div class="container">
         <h1>welcome to market</h1>

        <div class="row">
          <div v-for="(row,index) in nft_list"  class="col-md-3"  v-on:click="nftInfo(row)">
            <div class="NFT">
              <div class="NFT_IMAGE">
                <img  class="nft_image"  v-bind:src="ipfs_url+row.image"  ><br/>
              </div>
              <div class="NFT_NAME">
                <b>{{row.name}}</b>
              </div>
              <div class="NFT_PRICE">
                <b>{{currency}} {{row.price}}</b>
              </div>
              <div class="NFT_PRICE">
                <button  class="btn btn-info btn-block">Buy</button>
              </div>
            </div>
              
          </div>
        </div>
      </div>

     

  </div>
  <!-------------------------------------------------------->
  <div class="page"  v-if="page=='nft_info'" >
     
      <div class="container">
         <h1>NFT DETAILS</h1>

        <div class="row">
          <div  class="col-md-6">
            <img  style="width:80%"  v-bind:src="ipfs_url+single_nft.image"  >
          </div>
          <div  class="col-md-6">
            <h1>{{single_nft.name}}</h1>
            <p>{{single_nft.description}}</p>
            <h1>{{currency}} {{single_nft.price}}</h1>
            <button v-if="wallet_connected" class="btn btn-primary btn-lg" v-on:click="buyNft(single_nft)" >Buy</button>
            <p v-if="!wallet_connected"> Please connect wallet</p>
          </div>
        </div>

      </div>
      

     

  </div>
  <!-------------------------------------------------------->
  <div class="page"  v-if="page=='create'"  v-on:submit="listNFTForSale()">
      

      <div class="container">
        <h1>Create NFT</h1>
        <form action="" id="NFT_FORM" v-if="wallet_connected" >
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="" class="form-control" v-model="create_nft_name" required >
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" v-model="create_nft_description"  rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>File <i class="fa fa-spinner fa-spin" v-if="upload_loader" ></i> </label>
            <input type="file" id="user_file" v-on:change="uploadFile(event)" name="" required>
            <img  v-if="create_nft_url!=''" class="form_image"  v-bind:src="create_nft_url">
          </div>
          <div class="form-group">
            <label>Price ({{currency}})</label>
            <input type="number" v-model="create_nft_price" step="any" name="" class="form-control" required >
          </div>
          <div class="form-group">
            <button class="btn btn-primary"  >Create</button>
          </div>
        </form>
        <p v-if="!wallet_connected"> Please connect wallet</p>
      </div>

      
  </div>
  <!-------------------------------------------------------->
  <div class="page"  v-if="page=='market'" ></div>
  <div class="page"  v-if="page=='market'" ></div>

  
  


	
</div>


<script src="./assets/js/web3.min.js"></script>
<script src="./assets/js/web3Modal.js"></script>
<script src="./assets/js/evm.js"></script>
<script src="./assets/js/web3Provider.js"></script>
<script src="./assets/js/fortmatic.js"></script>
<script src="./assets/js/ethers-5.0.umd.min.js"></script>
<script src="./assets/js/ipfs.js"></script>
<script src="./assets/js/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

   var marketplaceAddress = "0x6375e2b83df602cfc50f0b791dd874e74b63d3a9";

      var ABIX = '[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"approved","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":false,"internalType":"bool","name":"approved","type":"bool"}],"name":"ApprovalForAll","type":"event"},{"inputs":[{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"approve","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"createMarketSale","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"string","name":"tokenURI","type":"string"},{"internalType":"uint256","name":"price","type":"uint256"}],"name":"createToken","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"payable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"},{"indexed":false,"internalType":"address","name":"seller","type":"address"},{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"uint256","name":"price","type":"uint256"},{"indexed":false,"internalType":"bool","name":"sold","type":"bool"}],"name":"MarketItemCreated","type":"event"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"uint256","name":"price","type":"uint256"}],"name":"resellToken","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"bytes","name":"_data","type":"bytes"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"operator","type":"address"},{"internalType":"bool","name":"approved","type":"bool"}],"name":"setApprovalForAll","outputs":[],"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"transferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_listingPrice","type":"uint256"}],"name":"updateListingPrice","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchItemsListed","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMarketItems","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMyNFTs","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"getApproved","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getListingPrice","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"operator","type":"address"}],"name":"isApprovedForAll","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"ownerOf","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes4","name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"tokenURI","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}]';

  const client = window.IpfsHttpClient.create('https://ipfs.infura.io:5001/api/v0');

var vue_app = new Vue({
  el: '#vue_app',
  data: {
    message: 'Hello Vue!',
    page:'market',
    cart_Delivery:0,
    wallet_connected:false,
    wallet_address:"",
    currency:"ETH",
    upload_loader:false,
    create_nft_url:'',
    create_nft_name:'',
    create_nft_description:'',
    create_nft_price:'',
    create_nft_url:'',
    added:{},
    nft_list:[],
    nft_raw_data:[],
    ipfs_url:'https://ipfs.infura.io/ipfs/',
    single_nft:{},
  },
  methods: {
    true_login: function () {
    this.user_login = true;
    },
    make_requets:function(url,data_object,type){
      return new Promise(output => {
        if (type!='no_loading'){
        $('#preloaderX').fadeIn();  
        }   
        this.place_order_status = false;

        this.info_product = [];
          $.post(url,data_object,
              function(data, status){
                $('#preloaderX').fadeOut('slow');
                if (type!='no_loading'){
                $("html, body").animate({ scrollTop: 0 }, "slow");
              }
                var js_return = []; 
                try {
                     js_return =  JSON.parse(data);
                    }
                    catch(err) {
                      console.log(err);
                    } 

                    output(js_return);
                    
                  });
                  
              });
    },

    uploadFile: async function (e) {
      const file = e.target.files[0];
        try {
          this.upload_loader = true;
          this.create_nft_url = '';
          const added = await client.add(
            file,
            {
              progress: (prog) => console.log(`received: ${prog}`)
            }
          )
          this.upload_loader = false;
          this.added = added;
          
          const url = `https://ipfs.infura.io/ipfs/${added.path}`;
          this.create_nft_url = url;
        } catch (error) {
          console.log('Error uploading file: ', error)
        }  
      
    }
    ,
    uploadToIPFS: async function () {



      const metadata = JSON.stringify({
        name:this.create_nft_name, description:this.create_nft_description, image: this.added.path
      })

      const data = JSON.stringify(metadata)
      console.log(data);
        try {
          const added = await client.add(data);
          const url = `https://ipfs.infura.io/ipfs/${added.path}`;
          return url;
        } catch (error) {
          console.log('Error uploading file: ', error)
        }  
    }
    ,
    listNFTForSale: async function () {
      event.preventDefault();
      console.log(5599);
      const url = await this.uploadToIPFS();
      const web3Modal = new Web3Modal();
      const connection = await web3Modal.connect();
      const provider = new ethers.providers.Web3Provider(connection);
      const signer = provider.getSigner();

      /* next, create the item */
      const price = ethers.utils.parseUnits(this.create_nft_price, 'ether');
      let contract = new ethers.Contract(marketplaceAddress, ABIX, signer);
      console.log(contract);
      let listingPrice = await contract.getListingPrice();
      listingPrice = listingPrice.toString();
      let transaction = await contract.createToken(url, price, { value: listingPrice });
      await transaction.wait();
      console.log(transaction);
      document.getElementById("NFT_FORM").reset();
      document.getElementById("user_file").value = null;
      this.page="market";
      this.loadNFTs();
      alert("done");
      
    }
    ,
    loadNFTs: async function () {
      const provider = new ethers.providers.JsonRpcProvider('https://ropsten.infura.io/v3/dba6c58f76174ffb863f948ac543f682')
          const contract = new ethers.Contract(marketplaceAddress, ABIX, provider);
          const data = await contract.fetchMarketItems();
          this.nft_raw_data = data;

          console.log(data);

          const items = await Promise.all(data.map(async i => {
            const tokenUri = await contract.tokenURI(i.tokenId);
             const meta = await axios.get(tokenUri);
             var image = '';
             var name = '';
             var description = '';
             try {
                var NFT =  JSON.parse(meta.data);
                 console.log(NFT);
                if(NFT.image!=undefined){
                    image = NFT.image;
                }
                if(NFT.name!=undefined){
                    name = NFT.name;
                }
                if(NFT.description!=undefined){
                    description = NFT.description;
                }
              }
              catch(err) {
              }
            
              let price = ethers.utils.formatUnits(i.price.toString(), 'ether')
              let item = {
                price,
                tokenId: i.tokenId.toNumber(),
                seller: i.seller,
                owner: i.owner,
                image: image,
                name: name,
                description: description,
              }
            return item
          }));
          this.nft_list = items;
        console.log(items);
    },
    nftInfo: async function (obj) {
      this.page = "nft_info"
      this.single_nft = obj;
    },
    buyNft: async function (nft) {
    /* needs the user to sign the transaction, so will use Web3Provider and sign it */
    const web3Modal = new Web3Modal()
    const connection = await web3Modal.connect()
    const provider = new ethers.providers.Web3Provider(connection)
    const signer = provider.getSigner()
    const contract = new ethers.Contract(marketplaceAddress, ABIX, signer)

    /* user will be prompted to pay the asking proces to complete the transaction */
    const price = ethers.utils.parseUnits(nft.price.toString(), 'ether')   
    const transaction = await contract.createMarketSale(nft.tokenId, {
      value: price
    })
    await transaction.wait()
    this.page = "market";
    this.loadNFTs()
  }
  
/*-------------------------------*/
},
mounted () {

  this.loadNFTs();

  // this.localstorage_init();
  // this.get_settings();
  // this.home_page_fun();
  // this.get_slider(); 


    
  }
});



    $('.carousel').carousel({
  interval: 1000
})






  </script>





<script type="text/javascript">
    "use strict";
const Web3Modal = window.Web3Modal.default;
const WalletConnectProvider = window.WalletConnectProvider.default;
const Fortmatic = window.Fortmatic;
const evmChains = window.evmChains;
let web3Modal
let provider;
let selectedAccount;
/*----------------------------*/
function init() {
  console.log("Initializing example");
  console.log("WalletConnectProvider is", WalletConnectProvider);
  console.log("Fortmatic is", Fortmatic);
  console.log("window.web3 is", window.web3, "window.ethereum is", window.ethereum);
  /*
  if(location.protocol !== 'https:') {
    // https://ethereum.stackexchange.com/a/62217/620
    const alert = document.querySelector("#alert-error-https");
    alert.style.display = "block";
    document.querySelector("#btn-connect").setAttribute("disabled", "disabled")
    return;
  }
  */

  // Tell Web3modal what providers we have available.
  const providerOptions = {
    /*
    walletconnect: {
      package: WalletConnectProvider,
      options: {
        // Mikko's test key - don't copy as your mileage may vary
        infuraId: "8043bb2cf99347b1bfadfb233c5325c0",
      }
    },

    fortmatic: {
      package: Fortmatic,
      options: {
        // Mikko's TESTNET api key
        key: "pk_test_391E26A3B43A3350"
      }
    }
    */
  };

  web3Modal = new Web3Modal({
    cacheProvider: false, // optional
    providerOptions, // required
    disableInjectedProvider: false, // optional. For MetaMask / Brave / Opera.
  });
  console.log("Web3Modal instance is", web3Modal);
}
/*----------------------------*/
async function fetchAccountData() {
  const web3 = new Web3(provider);
  console.log("Web3 instance is", web3);
  const chainId = await web3.eth.getChainId();
  console.log("chainId",chainId);
  if (chainId!=3){
    alert('swith to ropsten network and try again');
    return false;
  }
  const chainData = evmChains.getChain(chainId);
  console.log("chainData",chainData);
  const accounts = await web3.eth.getAccounts();
  console.log("accounts",accounts);
  console.log("Got accounts", accounts);
  selectedAccount = accounts[0];
  vue_app.wallet_address = selectedAccount;
  const rowResolvers = accounts.map(async (address) => {
    const balance = await web3.eth.getBalance(address);
    // ethBalance is a BigNumber instance
    // https://github.com/indutny/bn.js/
    const ethBalance = web3.utils.fromWei(balance, "ether");
    const humanFriendlyBalance = parseFloat(ethBalance).toFixed(4);
    console.log("humanFriendlyBalance",humanFriendlyBalance);
  });
  await Promise.all(rowResolvers);
  vue_app.wallet_connected = true;
}
/*----------------------------*/
async function refreshAccountData() {
  await fetchAccountData(provider);
}
/*----------------------------*/
async function onConnect() {
  console.log("Opening a dialog", web3Modal);
  try {
    provider = await web3Modal.connect();
  } catch(e) {
    alert('Could not get a wallet connection');
    console.log("Could not get a wallet connection", e);
    return;
  }
  provider.on("accountsChanged", (accounts) => {
    fetchAccountData();
  });
  provider.on("chainChanged", (chainId) => {
    fetchAccountData();
  });
  provider.on("networkChanged", (networkId) => {
    fetchAccountData();
  });

  await refreshAccountData();
}

/*----------------------------*/
async function onDisconnect() {
  vue_app.wallet_connected = false;
  console.log("Killing the wallet connection", provider);
  if(provider.close) {
    await provider.close();
    await web3Modal.clearCachedProvider();
    provider = null;
  }
  selectedAccount = null;
}
/*----------------------------*/
window.addEventListener('load', async () => {
  init();
  document.querySelector("#btn-connect").addEventListener("click", onConnect);
  document.querySelector("#btn-disconnect").addEventListener("click", onDisconnect);
});
  </script>


</body>
</html>



