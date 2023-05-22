const urlBttn = document.querySelector('#url_increment');
let extraFileds = document.querySelector('.url-extra-field');

const createFiled = () => {
    let div = document.createElement("div");
    let node = document.createElement("input");
    node.setAttribute("class", "form-control @error('social_links') is-invalid @enderror");
    node.setAttribute("multiple", "");
    node.setAttribute("type", "url");
    node.setAttribute("placeholder", "Enter Social Link");
    node.setAttribute("name", "social_links[]");
    let linkk = document.createElement("a");
    linkk.innerHTML = "<i class='fas fa-minus'></i>";
    linkk.setAttribute("onclick", "this.parentElement.style.display = 'none';");
    let divNew = extraFileds.appendChild(div);
    divNew.appendChild(node);
    divNew.appendChild(linkk);
}

urlBttn.addEventListener('click', createFiled, true);