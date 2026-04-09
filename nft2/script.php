 <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.1/web3.min.js" integrity="sha512-GKw4QT/RccGJIwQxY3MhyiQ5pHrhQ8SuKFEafV+WcpOvtz7iYFQuQGFCvmGlHLctJTe8KrWU1FqvF7VOkEAJtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        
         window.web3 = new Web3(ethereum);
        var csrf_token = "{{csrf_token()}}";
        
        async function metamaskEnable(){

          console.log(localStorage.getItem("lastname"));


            if (typeof window.ethereum !== 'undefined') {
              console.log('MetaMask is installed!');
            }else{
                alert('MetaMask Not installed!');
                return false;
            }
            var mtx = await ethereum.request({ method: 'eth_requestAccounts' });

            var current_account = mtx[0];
            let result = current_account.substr(0,5)+"...."+current_account.substr(current_account.length-6, current_account.length);

            $('#metamask_address').text(result);
            $('#metamask_button').hide();
 

            if (localStorage.getItem('metamask_logged_in')!=mtx[0]){
              var acx = await handleSignMessage('welcome to The SharePage NFT',mtx[0]);
            
               $.post("<?php echo $BaseUrl ?>/nft/api.php",
                {
                  address: acx.publicAddress,
                  signature: acx.signature,
                },
                function(data, status){

                  localStorage.setItem('metamask_logged_in', mtx[0]);
                  
                    try {
                        
                       var  resp = JSON.parse(data);
                       
                       if(resp.code==1){
                          $('#metamask_address').val(resp.output.user.metamask_address); 
                          $('#metamask_form').submit();

                          

                       }
                       
                        
                      }catch(err) {
                       
                      }
                  
                });
            }

            console.log(acx);
        }
        
        
        //handleSignMessage(message, publicAddress).then(handleAuthenticate);

          function handleSignMessage(message, publicAddress) {
            return new Promise((resolve, reject) =>  
              web3.eth.personal.sign(
                web3.utils.utf8ToHex(message),
                publicAddress,
                (err, signature) => {
                  if (err) vm.state = "loggedOut";
                  return resolve({ publicAddress, signature });
                }
              )
            );
          }



          async function disconnect(){
            await window.ethereum.request({
                method: "eth_requestAccounts",
                params: [{eth_accounts: {}}]
            })
                localStorage.clear();
                location.reload();
          }


          $(document).ready(function(){

             if (localStorage.getItem('metamask_logged_in')!=null){
                metamaskEnable();
             }
           
          });


    </script>
