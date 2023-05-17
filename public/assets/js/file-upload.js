// one file upload script @S
const fileInput = document.getElementById("file-upload");
fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    const fileReader = new FileReader();
    fileReader.onload = () => {
      const filePreview = document.createElement("img");
      filePreview.src = fileReader.result;
      filePreview.classList.add("file-preview");
      document.getElementById("file-previews").appendChild(filePreview);
      document.getElementById("close-button").style.display = "inline-flex";
    };
    fileReader.readAsDataURL(file);
  }
});
const closeButton = document.getElementById("close-button");
closeButton.addEventListener("click", () => {
  const filePreview = document.querySelector(".file-preview");
  filePreview.remove();
  fileInput.value = null;
  document.getElementById("close-button").style.display = "none";
});
// one file upload script @E

// two file upload script @S
const fileInput2 = document.getElementById("file-upload-2");
fileInput2.addEventListener("change", () => {
  const file = fileInput2.files[0];
  if (file) {
    const fileReader2 = new FileReader();
    fileReader2.onload = () => {
      const filePreview2 = document.createElement("img");
      filePreview2.src = fileReader2.result;
      filePreview2.classList.add("file-preview-2");
      document.getElementById("file-previews-2").appendChild(filePreview2);
      document.getElementById("close-button-2").style.display = "inline-flex";
    };
    fileReader2.readAsDataURL(file);
  }
});
const closeButton2 = document.getElementById("close-button-2");
closeButton2.addEventListener("click", () => {
  const filePreview2 = document.querySelector(".file-preview-2");
  filePreview2.remove();
  fileInput2.value = null;
  document.getElementById("close-button-2").style.display = "none";
});
// two file upload script @E

// three file upload script @S
const fileInput3 = document.getElementById("file-upload-3");
fileInput3.addEventListener("change", () => {
  const file = fileInput3.files[0];
  if (file) {
    const fileReader3 = new FileReader();
    fileReader3.onload = () => {
      const filePreview3 = document.createElement("img");
      filePreview3.src = fileReader3.result;
      filePreview3.classList.add("file-preview-3");
      document.getElementById("file-previews-3").appendChild(filePreview3);
      document.getElementById("close-button-3").style.display = "inline-flex";
    };
    fileReader3.readAsDataURL(file);
  }
});
const closeButton3 = document.getElementById("close-button-3");
closeButton3.addEventListener("click", () => {
  const filePreview3 = document.querySelector(".file-preview-3");
  filePreview3.remove();
  fileInput3.value = null;
  document.getElementById("close-button-3").style.display = "none";
});
// three file upload script @E