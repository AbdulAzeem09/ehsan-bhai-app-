<script src="./assets/js/web3.min.js"></script>
<script src="./assets/js/web3Modal.js"></script>
<script src="./assets/js/evm.js"></script>
<script src="./assets/js/web3Provider.js"></script>
<script src="./assets/js/fortmatic.js"></script>
<script src="./assets/js/ethers-5.0.umd.min.js"></script>
<script src="./assets/js/ipfs.js"></script>
<script src="./assets/js/vue.js"></script>
<script src="./assets/js/q.js"></script>
<script src="./assets/js/spark-md5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

   var marketplaceAddress = "0x8940545BeDe6415a5169c40701dF065955dade6f";
   var marketplace_owner = "0xc323B7b1a160e8221FC3962B5279488A7a9B4fa8";

      var ABIX = '[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"approved","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":false,"internalType":"bool","name":"approved","type":"bool"}],"name":"ApprovalForAll","type":"event"},{"inputs":[{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"approve","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"createMarketSale","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"string","name":"tokenURI","type":"string"},{"internalType":"uint256","name":"price","type":"uint256"}],"name":"createToken","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"payable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"},{"indexed":false,"internalType":"address","name":"seller","type":"address"},{"indexed":false,"internalType":"address","name":"owner","type":"address"},{"indexed":false,"internalType":"uint256","name":"price","type":"uint256"},{"indexed":false,"internalType":"bool","name":"sold","type":"bool"}],"name":"MarketItemCreated","type":"event"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"uint256","name":"price","type":"uint256"}],"name":"resellToken","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"bytes","name":"_data","type":"bytes"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"operator","type":"address"},{"internalType":"bool","name":"approved","type":"bool"}],"name":"setApprovalForAll","outputs":[],"stateMutability":"nonpayable","type":"function"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"transferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_listingPrice","type":"uint256"}],"name":"updateListingPrice","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchItemsListed","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMarketItems","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"fetchMyNFTs","outputs":[{"components":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"address payable","name":"seller","type":"address"},{"internalType":"address payable","name":"owner","type":"address"},{"internalType":"uint256","name":"price","type":"uint256"},{"internalType":"bool","name":"sold","type":"bool"}],"internalType":"struct NFTMarketplace.MarketItem[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"getApproved","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getListingPrice","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"operator","type":"address"}],"name":"isApprovedForAll","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"ownerOf","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes4","name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"tokenURI","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}]';

  const client = window.IpfsHttpClient.create('https://ipfs.infura.io:5001/api/v0');

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
let uid = parseInt('<?php echo $_SESSION['uid']; ?>');
let pid = parseInt('<?php echo $_SESSION['pid']; ?>');

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
  console.log('provider fetchAccountData',provider);
  const web3 = new Web3(provider);
  console.log("Web3 instance is", web3);
  const chainId = await web3.eth.getChainId();
  console.log("chainId",chainId);
  if (chainId!=3){
    alert('switch to ropsten network and try again'); 
    return false;
  }
  const chainData = evmChains.getChain(chainId);
  console.log("chainData",chainData);
  const accounts = await web3.eth.getAccounts();
  console.log("accounts",accounts);
  console.log("Got accounts", accounts);
  selectedAccount = accounts[0];

   $.post("./api.php",
  {
    action: "update_user_wallet_address",
    address: selectedAccount
  },
  function(data, status){
    console.log(data);
  });

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


<script type="text/javascript">

var vue_app = new Vue({
  el: '#vue_app',
  data: {
    message: 'Hello Vue!',
    page:'market',
    cart_Delivery:0,
    wallet_connected:false,
    wallet_address:"",
    marketplace_owner:marketplace_owner,
    currency:"ETH",
    upload_loader:false,
    create_nft_url:'',
    create_nft_name:'',
    create_nft_ext:'',
    create_nft_md5:'',
    create_nft_description:'',
    create_nft_price:'',
    create_nft_url:'',
    create_nft_category:'',
    added:{},
    nft_list:[],
    nft_list_org:[],
    nft_raw_data:[],
    my_nft_list:[],
    my_listed_nft:[],
    ipfs_url:'https://ipfs.infura.io/ipfs/',
    single_nft:{},
    single_nft_other:[],
    eth_price : 0,
    commission_price : 0,
    resell_nft:{},
    nft_category:[],
    edit_nft_name:'',
    edit_nft_id:'',
    list_nft_category:0,
    preloader:1,
    create_enable:1,
    create_loading:0,
  },
  methods: {
    true_login: function () {
    this.user_login = true;
    },
    getEthPrice: async function () {
      let response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd,eth');
      let data = await response.json();

      if (data.ethereum.usd!=undefined){
        this.eth_price = data.ethereum.usd;
      }
    },
    route: function (address) {
      console.log(address);
     if (address=="dashboard"){
        // if (this.wallet_connected==false){
        //   alert('connect wallet first');
        //   return false;

        // }
         this.fetchMyNFTs();
         this.myListedNft();
     }

     if (address=="setting"){
      this.getCommissionPrice();
     }
     console.log(address);
     this.page = address;
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
    getOwnerInfo:function(address){
      return new Promise(output => {
          $.post('./api.php',
            {
              action: "get_owner_data",
              address: address
            },
              function(data, status){
                try {
                     js_return =  JSON.parse(data);
                      output(js_return);
                    }
                    catch(err) {
                      console.log(err);
                      output({});
                    } 
                  });
              });
    },
    uploadFile: async function (e) {
      const file = e.target.files[0];
      var bufferSize = Math.pow(1024, 2) * 10; // 10MB
        calculateMD5Hash(file, bufferSize).then(
          function(result) {
            // Success
           // console.log(result);
           if (result.hashResult){
            vue_app.create_nft_md5 = result.hashResult;
           }
          },
          function(err) {
            // There was an error,
          },
          function(progress) {
            // We get notified of the progress as it is executed
            console.log(progress.currentPart, 'of', progress.totalParts, 'Total bytes:', progress.currentPart * bufferSize, 'of', progress.totalParts * bufferSize);
          });
       this.create_nft_ext = file.name.split('.').pop().toLowerCase();
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
        name:this.create_nft_name, description:this.create_nft_description, image: this.added.path,uid:uid,pid:pid,ext:this.create_nft_ext,md5:this.create_nft_md5,category_id:this.create_nft_category
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
     // console.log(5599);
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
      this.create_loading = 1;
      this.resetNftForm();
      await transaction.wait();
       this.create_loading = 0;
      console.log(transaction);
      document.getElementById("NFT_FORM").reset();
      
      this.page="market";
      this.loadNFTs();
      alert("done");

      
    },
    resetNftForm: function () {
      this.create_nft_name = "";
      this.create_nft_category = "";
      this.create_nft_description = "";
      this.create_nft_url = "";
      this.create_nft_price = "";
      document.getElementById("user_file").value = null;
      

    }
    ,
    getCommissionPrice: async function () {
       let web3Modal = new Web3Modal();
          let connection = await web3Modal.connect();
          let provider = new ethers.providers.Web3Provider(connection);
          let signer = provider.getSigner();
      let contract = new ethers.Contract(marketplaceAddress, ABIX, signer);
      let listingPrice = await contract.getListingPrice();
      console.log('listingPrice',listingPrice);
      listingPrice = listingPrice.toString()/1000000000000000000;
      this.commission_price = listingPrice;
      
    }
    ,
    loadNFTs: async function () {
      const provider = new ethers.providers.JsonRpcProvider('https://ropsten.infura.io/v3/dba6c58f76174ffb863f948ac543f682')
          const contract = new ethers.Contract(marketplaceAddress, ABIX, provider);
          const data = await contract.fetchMarketItems();
          this.nft_raw_data = data;

          console.log('fetchMarketItems',data);

          const items = await Promise.all(data.map(async i => {
            const tokenUri = await contract.tokenURI(i.tokenId);
             const meta = await axios.get(tokenUri);
             var userobj = await vue_app.getOwnerInfo(i.seller);
           
             var image = '';
             var name = '';
             var description = '';
             var user_name = '';
             var category_id = 0;
             var category_name = "";
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

                if(NFT.category_id!=undefined){
                    category_id = NFT.category_id;
                }

                if(userobj.output.spUserName!=undefined){
                    user_name = userobj.output.spUserName;
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
                user_name: user_name,
                category_id: category_id,
                category_name: category_name,
              }
            return item
          }));
          this.nft_list = items;
        console.log(items);

    },
    fetchMyNFTs: async function () {
          let web3Modal = new Web3Modal()
          let connection = await web3Modal.connect()
          let provider = new ethers.providers.Web3Provider(connection)
          let signer = provider.getSigner()
          let contract = new ethers.Contract(marketplaceAddress, ABIX,signer);
          let data = await contract.fetchMyNFTs();
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
          this.my_nft_list = items;
    },
    nftInfo: async function (obj) {
      this.page = "nft_info"
      this.single_nft = obj;

      console.log(obj);

      var tmx = [];

      for (var i = 0; i < this.nft_list.length; i++) {
        if (this.nft_list[i]['seller']==obj.seller){
          tmx.push(this.nft_list[i]);
        }
        
      }

      this.single_nft_other = tmx;


    },
    myListedNft: async function () {
     

      var tmx = [];

      for (var i = 0; i < this.nft_list.length; i++) {
        if (this.nft_list[i]['seller']==this.wallet_address){
          tmx.push(this.nft_list[i]);
        }
        
      }

      this.my_listed_nft = tmx;


    },
    buyNft: async function (nft) {
      if (confirm("Do You want to buy this NFT ?") == true) {
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
    
  },
  updateListingPrice: async function () {

    var listingPrice = this.commission_price;
    if (listingPrice<0.001){
      alert('price is too low '+listingPrice);
      return 0;
    }
    /* needs the user to sign the transaction, so will use Web3Provider and sign it */
    const web3Modal = new Web3Modal();
    const connection = await web3Modal.connect();
    const provider = new ethers.providers.Web3Provider(connection);
    const signer = provider.getSigner();
    const contract = new ethers.Contract(marketplaceAddress, ABIX, signer);

    /* user will be prompted to pay the asking proces to complete the transaction */
    const price = ethers.utils.parseUnits(listingPrice.toString(), 'ether');   
    const transaction = await contract.updateListingPrice(price);
    await transaction.wait();

  },
  nftResell: async function (obj) {

    if (confirm("Do You want to sell this NFT ?") == true) {
      this.page = "nft_resell"
      this.resell_nft = obj;
    }
      
    },
  resellProcess: async function (obj) {
      var nft = this.resell_nft;
      if (nft.price<0.001){
        alert('price is too low '+listingPrice);
        return 0;
      }

    /* needs the user to sign the transaction, so will use Web3Provider and sign it */
    const web3Modal = new Web3Modal();
    const connection = await web3Modal.connect();
    const provider = new ethers.providers.Web3Provider(connection);
    const signer = provider.getSigner();
    const contract = new ethers.Contract(marketplaceAddress, ABIX, signer);
    var final_price = nft.price;
    const price = ethers.utils.parseUnits(final_price.toString(), 'ether'); 
      let listingPrice = await contract.getListingPrice();
      listingPrice = listingPrice.toString();
    /* user will be prompted to pay the asking proces to complete the transaction */
    const transaction = await contract.resellToken(nft.tokenId,price, { value: listingPrice });
    await transaction.wait();
    this.page = "market";
    this.loadNFTs();
    },
    getNFTCategory:function(address){
      return new Promise(output => {
          $.post('./api.php',
            {
              action: "get_nft_category",
            },
              function(data, status){
                try {
                     obj =  JSON.parse(data);
                      vue_app.nft_category = obj.output;
                    }
                    catch(err) {
                      console.log(err);
                      
                    } 
                  });
              });
    },
    nftCategoryEdit:function(category){

      $('#nft_category_modal').modal('show');

      if (category!=undefined){
        this.edit_nft_name = category.name;
        this.edit_nft_id = category.id;
      }else{
        this.edit_nft_name = '';
        this.edit_nft_id = 0;
      }

      
    },
    nftCategoryUpdate:function(category){
      event.preventDefault();
      $('#nft_category_modal').modal('hide');

      var id = this.edit_nft_id;
      var name  = this.edit_nft_name;

      return new Promise(output => {
          $.post('./api.php',
            {
              action: "update_nft_category",
              id:id,
              name:name
            },
              function(data, status){
                vue_app.getNFTCategory();
              });

          });
    },
    nftCategoryDelete:function(id){

      return new Promise(output => {
          $.post('./api.php',
            {
              action: "delete_nft_category",
              id:id
            },
              function(data, status){
                vue_app.getNFTCategory();
              });

          });
    },
      
/*-------------------------------*/
},
mounted () {

  this.loadNFTs();
  this.getEthPrice();
  this.getNFTCategory();
  this.preloader = 0;
  //this.getCommissionPrice();
  //this.fetchMyNFTs();

  // this.localstorage_init();
  // this.get_settings();
  // this.home_page_fun();
  // this.get_slider(); 



 



    
  }
});



function calculateMD5Hash(file, bufferSize) {
  var def = Q.defer();
  var fileReader = new FileReader();
  var fileSlicer = File.prototype.slice || File.prototype.mozSlice || File.prototype.webkitSlice;
  var hashAlgorithm = new SparkMD5();
  var totalParts = Math.ceil(file.size / bufferSize);
  var currentPart = 0;
  var startTime = new Date().getTime();

  fileReader.onload = function(e) {
    currentPart += 1;

    def.notify({
      currentPart: currentPart,
      totalParts: totalParts
    });

    var buffer = e.target.result;
    hashAlgorithm.appendBinary(buffer);

    if (currentPart < totalParts) {
      processNextPart();
      return;
    }

    def.resolve({
      hashResult: hashAlgorithm.end(),
      duration: new Date().getTime() - startTime
    });
  };

  fileReader.onerror = function(e) {
    def.reject(e);
  };

  function processNextPart() {
    var start = currentPart * bufferSize;
    var end = Math.min(start + bufferSize, file.size);
    fileReader.readAsBinaryString(fileSlicer.call(file, start, end));
  }

  processNextPart();
  return def.promise;
}

function calculate() {

  var input = document.getElementById('file');
  if (!input.files.length) {
    return;
  }

  var file = input.files[0];
  var bufferSize = Math.pow(1024, 2) * 10; // 10MB
  calculateMD5Hash(file, bufferSize).then(
    function(result) {
      // Success
      console.log(result);
    },
    function(err) {
      // There was an error,
    },
    function(progress) {
      // We get notified of the progress as it is executed
      console.log(progress.currentPart, 'of', progress.totalParts, 'Total bytes:', progress.currentPart * bufferSize, 'of', progress.totalParts * bufferSize);
    });
}
</script>






