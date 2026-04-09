function openAndCloseSideBar(){
    const sideBar = document.getElementById('side-bar');
    if(sideBar.style.transform == 'translateY(-300%)') {
        sideBar.style.transform = 'translateY(0%)'
    } else {
        sideBar.style.transform = 'translateY(-300%)'
    }
}
function threeDot() {
    const dotContent = document.getElementById('three-dot')
    if(dotContent.style.display == 'none') {
        dotContent.style.display = 'flex'
    } else {
        dotContent.style.display = 'none'
    }
}