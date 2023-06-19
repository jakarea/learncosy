let menuShow = document.getElementById('mobile-menu-toggle');
    let mainMenus = document.getElementById('main-menu');
    const showMenu = () => {
      mainMenus.classList.toggle('show-menu'); 
    }
    menuShow.addEventListener('click', showMenu);