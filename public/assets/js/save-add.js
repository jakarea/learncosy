const baseUrl = document.querySelector('meta[name="base-url"]').getAttribute('content');
const projectForm = document.getElementById('projectForm');

const adspyModal = document.getElementById("adspy-modal");
const openModal = document.querySelector(".adspy-head-bttn a");
const closedModal = document.querySelector(".btn-closes");

const opepnModal = () => {
    adspyModal.style.display = "block";
}

const closeModal = () => {
    adspyModal.style.display = "none";
}

openModal.addEventListener("click", opepnModal);
closedModal.addEventListener("click", closeModal);

projectForm.addEventListener('submit', async function (event) {
    event.preventDefault();
    let project_id = document.getElementById("project_id").value;
    let project_name = document.getElementById("project_name").value;
    let ad_id = document.getElementById("ad_id").value;

    try {
        const url = baseUrl + '/adspy/facebook2/save-ad2/save-project-new';
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ project_id, project_name, ad_id })
        });
        const data = await response.json();

        if (data) {
            toastr["success"]("Added to project", "Success!")
            let status = data[1];
            let projects = data[0];
            document.getElementById("project_name").value = '';
            closeModal();
            project_id = '';
            project_name = '';
            var selectElement = document.getElementById("project_id");

            // Remove all existing options
            selectElement.innerHTML = "";
            let option = new Option('Select Below', '');
            selectElement.add(option);
            projects.forEach(project => {
                let option = new Option(project.name, project.id);
                selectElement.add(option);
            })
        }
    } catch (error) {
        console.error(error);
    }
});

