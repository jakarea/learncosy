// const projectForm = document.getElementById('projectForm');
// const adspyModal = document.getElementById("adspy-modal");
// const closeAdspyModal = document.getElementById("close-adspy-modal");
// const setAdId = document.getElementById("ad-data");
// const closeModal = () => {
//     adspyModal.style.display = "none";
// }

// projectForm.addEventListener('submit', async function (event) {
//     event.preventDefault();
//     let project_id = document.getElementById("project_id").value;
//     let project_name = document.getElementById("project_name").value;
//     let adData = JSON.parse(document.getElementById("adData").value);

//     if (project_id === "" && project_name === "") {
//         toastr["error"]("Please enter a project name or select a project", "Attention!")
//         return false;
//     }

//     try {
//         const url = baseUrl + '/adspy/facebook2/save-ad2/save-project';
//         const response = await fetch(url, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             body: JSON.stringify({ project_id, project_name, adData })
//         });
//         const data = await response.json();

//         if (data) {
//             let status = data[1];
//             let projects = data[0];
//             document.getElementById("project_name").value = '';
//             closeModal();
//             project_id = '';
//             project_name = '';
//             adData = '';
//             var selectElement = document.getElementById("project_id");

//             // Remove all existing options
//             selectElement.innerHTML = "";
//             let option = new Option('Select Below', '');
//             selectElement.add(option);
//             projects.forEach(project => {
//                 let option = new Option(project.name, project.id);
//                 selectElement.add(option);
//             })
//             toastr["success"]("Added to project", "Success!")
//         }
//     } catch (error) {
//         console.error(error);
//     }
// });


// async function saveAd(adId, addToList = false) {
//     const mergedAd = Object.assign({}, savedAds[adId], savedAdsContent[adId], { addToList });

//     try {
//         const url = baseUrl + '/adspy/facebook2/save-ad2/yes';
//         const response = await fetch(url, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             body: JSON.stringify(mergedAd)
//         });
//         const data = await response.json();
//         if (!addToList) {
//             window.open(baseUrl + '/adspy/facebook/' + data.ad_id, '_blank');
//         }
//     } catch (error) {
//         console.error(error);
//     }
// }


// closeAdspyModal.addEventListener("click", closeModal);

// document.addEventListener('click', function (event) {
//     if (event.target.classList.contains('preventDefault')) {
//         event.preventDefault();
//         let save = 0;
//         // Get data-id attribute from clicked element
//         var adId = event.target.getAttribute('data-id');
//         if (event.target.classList.contains('saveAdToList')) {
//             save = 1;
//             adspyModal.style.display = "block";
//             adData.value = JSON.stringify(savedAds[adId]);
//         }
//         if (event.target.classList.contains('saveAdAndOpen')) {
//             save = 0;
//             saveAd(adId, save)
//         }
//     }
// });