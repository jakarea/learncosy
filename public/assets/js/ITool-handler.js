// setings modal js
let cards = document.querySelectorAll(".popular-imterest-box ul li a");
let selectedData = []
cards.forEach(card => {
    card.addEventListener("click", custmBorder);
});

function custmBorder() {
    cards.forEach(c => c.classList.remove("active"));
    this.classList.add("active")
}

const settingToggle = document.querySelector("#settings-toggle");
const settingBox = document.querySelector(".search-settings-main-wrap");

if(settingBox){
    settingBox.addEventListener("click", function(event) {
        if (event.target == settingBox) {
            settingBox.style.display = "none";
        } 
    });
}

if(settingToggle){
    settingToggle.addEventListener("click", expandFunction)
}

function expandFunction(event) {
    event.preventDefault();
    settingBox.style.display = "block";
}

// copy bttn dialog js
const copyBttn = document.querySelector("#copy-bttn");
const selectionArea = document.querySelector(".selection-textbox");
const checkIcon = selectionArea.querySelector(".fa-check");
const project_details = document.getElementById('project_details')

const selectionCopyFunction = () => {
    selectionArea.classList.add("selection-textbox-check");
    checkIcon.style.opacity = "1";
    navigator.clipboard.writeText(textArea.value);

    setTimeout(() => {
        selectionArea.classList.remove("selection-textbox-check");
        checkIcon.style.opacity = "0";
    }, 1000);
}

copyBttn.addEventListener("click", selectionCopyFunction);

// selection clear js
const clearCopy = document.querySelector("#clear-copy-box");
let textArea = document.querySelector("#selection-box");

const clearCopyFunction = () => {
    textArea.value = "";
}

clearCopy.addEventListener("click", clearCopyFunction);

// copy and append text js
const tableChecks = document.querySelectorAll("table .form-check-input");

const copyFunction = (e) => {
   
    if (e.target.checked == true) {
        if (!textArea.value.match(e.target.value + ',')) {
            textArea.value += e.target.value + ",";
            selectedData.push(e.target.getAttribute('data-rs'))
        }
    } else if (e.target.checked == false) {
        removed = textArea.value.replace(e.target.value + ',', '');
        textArea.value = removed
        selectedItem = JSON.parse(e.target.getAttribute('data-rs'))
        selectedData = selectedData.filter((item) => {
            parsedItem = JSON.parse(item)
            return parsedItem.id !== selectedItem.id
        })
    }
    if(project_details){
        project_details.value = JSON.stringify(selectedData)
    }
   
}

tableChecks.forEach((tableCheck) => {
    tableCheck.addEventListener('change', copyFunction)
});

// select all
const selectAll = document.querySelector(".select-all");
const labelValues = document.querySelectorAll(".copy-table-value");

const copyAllFunction = (e) => {
    if (e.target.checked) {
        selectedData = [];
        const newValues = [].slice.call(labelValues);
        let newValue = newValues.map((newValue) => newValue.outerText);
        textArea.value = newValue + ',';
        tableChecks.checked = true; 
        mainselects(true);
        var trs = document.getElementsByClassName("checkAndHide");
        for (var i = 0; i < trs.length; i++) {
            selectedData.push(trs[i].getAttribute('data-rs'))
        }
    } else {
        textArea.value = ""; 
        mainselects(false);
        selectedData = [];
    }
    if(project_details){
        project_details.value = JSON.stringify(selectedData)
    }
    
}

function mainselects(value) {
    let chks = document.getElementsByName('chks');
    for (let i = 0; i < chks.length; i++) {
        if (chks[i].type == 'checkbox')
            chks[i].checked = value;
    }
} 

selectAll.addEventListener('change', copyAllFunction);
// select all checkbox

// save project modal js
const openModal = document.getElementById("save-modal");
if(openModal)  {
    const openModalFunction = () => {
        projectModal.style.display = "block";
    }
    openModal.addEventListener("click", openModalFunction);


}
const projectModal = document.querySelector(".save-to-project-modal");
if(projectModal){
    const modalClose = projectModal.querySelector(".btn-closes");
    const closeModalFunction = () => {
        projectModal.style.display = "none";
    }
    modalClose.addEventListener("click", closeModalFunction);
    

projectModal.addEventListener("click", function(event) {
    if (event.target == projectModal) {
        projectModal.style.display = "none";
    } 
});
}




 




function handleClick(cb) {
    var target = cb.value;
    var checked = cb.checked;
    var trs = document.getElementsByClassName("checkAndHide");
    for (var i = 0; i < trs.length; i++) {
        if (checked && trs.item(i).value.includes(target)) {
            trs.item(i).parentElement.parentElement.parentElement.style.display = "none";
        }
        if (!checked && trs.item(i).value.includes(target)) {
            trs.item(i).parentElement.parentElement.parentElement.style.display = "revert";
        }
    }
}

function handleTopicClick(cb) {
    var target = cb.value;
    var checked = cb.checked;

    var trs2 = document.getElementsByClassName("checkAndHideTopic");
    for (var i = 0; i < trs2.length; i++) {
        if (checked && trs2.item(i).value.includes(target)) {
            trs2.item(i).parentElement.parentElement.parentElement.style.display = "none";
        }
        if (!checked && trs2.item(i).value.includes(target)) {
            trs2.item(i).parentElement.parentElement.parentElement.style.display = "revert";
        }
    }
}

function clearWordSelections() {
    var wcs = document.getElementsByClassName("wordClass");
    for (var i = 0; i < wcs.length; i++) {
        wcs.item(i).checked = false;
    }
    var trs = document.getElementsByClassName("checkAndHide");
    for (var i = 0; i < trs.length; i++) {
        trs.item(i).parentElement.parentElement.parentElement.style.display = "revert";
    }
    reTopicSelection();
}

function clearTopicSelections() {
    var wcs = document.getElementsByClassName("topicClass");
    for (var i = 0; i < wcs.length; i++) {
        wcs.item(i).checked = false;
    }

    var trs2 = document.getElementsByClassName("checkAndHideTopic");
    for (var i = 0; i < trs2.length; i++) {
        trs2.item(i).parentElement.parentElement.parentElement.style.display = "revert";
    }
    reWordSelection()
}

function reWordSelection() {
    var wcs = document.getElementsByClassName("wordClass");
    for (var i = 0; i < wcs.length; i++) {
        if (wcs.item(i).checked) {
            var trs = document.getElementsByClassName("checkAndHide");
            for (var j = 0; j < trs.length; j++) {
                if (trs.item(j).value.includes(wcs.item(i).value)) {
                    trs.item(j).parentElement.parentElement.parentElement.style.display = "none";
                }
            }
        }
    }
}

function reTopicSelection() {
    var wcs = document.getElementsByClassName("topicClass");
    for (var i = 0; i < wcs.length; i++) {
        if(wcs.item(i).checked){
            var trs = document.getElementsByClassName("checkAndHideTopic");
            for (var j = 0; j < trs.length; j++) {
                if(trs.item(j).value.includes(wcs.item(i).value)){
                    trs.item(j).parentElement.parentElement.parentElement.style.display = "none";
                }
            }
        }
    }
}

function createCSV(csvData){

    var keys = ["id","name","audience_size_upper_bound","topic"]
    var name = ["id","Interest","Audience","Topic"]
    var result = ''; 
    result += name.join(','); 
    result += '\n'; 
    
    csvData.forEach(function(item){ 
      keys.forEach(function(key){ 
        result += item[key] + ','; 
      })
      result += '\n';
    })
    
    return result;
  }
  
  
  function downloadCSV() {
    csvData = [];
    selectedData.forEach((data) => {
        csvData.push(JSON.parse(data))
    })
    csv = 'data:text/csv;charset=utf-8,' + createCSV(csvData); //Creates CSV File Format
    excel = encodeURI(csv); //Links to CSV 
  
    link = document.createElement('a');
    link.setAttribute('href', excel); //Links to CSV File 
    var file_name = document.getElementById('search_by').innerText
    link.setAttribute('download', file_name+'.csv'); //Filename that CSV is saved as
    link.click();
  }


const submitExplorer = document.getElementById("SubmitExplore")

if(submitExplorer){
    submitExplorer.addEventListener("click", function(event){
        event.preventDefault()
        document.getElementById('spiner').style.display = 'block'
        document.getElementById("searchForm").submit();
    });
    
    submitExplorer.addEventListener("click", function(event){
        event.preventDefault()
        document.getElementById('spiner').style.display = 'block'
        document.getElementById("searchForm").submit();
    });
}
