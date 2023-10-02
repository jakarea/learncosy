let menuToggle = document.getElementById('menu-toggle');
    let mainMenu = document.getElementById('main-menu');
    let pageBody = document.getElementById('page-body');
    const expandMenu = () => {
      mainMenu.classList.toggle('expanded-menu');
      pageBody.classList.toggle('expanded-body');
    }
    menuToggle.addEventListener('click', expandMenu);