const sideBar = document.getElementById('side-bar');
function openAndCloseSideBar(){
    if(sideBar.style.transform == 'translateY(-300%)') {
        sideBar.style.transform = 'translateY(0%)'
    } else {
        sideBar.style.transform = 'translateY(-300%)'
    }
}
