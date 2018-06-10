var edit = {};

// site vars
// concats 'pages:' with what is defined by siteNameSpace above where this file is included
edit.siteNameSpace = 'pages:' + siteNameSpace;
edit.editableElements = document.getElementsByClassName('jsEdit');
edit.ActivateUIBtn = document.getElementById('jsControl');
edit.ui = document.getElementById('editUI');
//dynamic area of ui
edit.UIInputContainer = document.getElementById('jsdataPointsCont');
// all save buttons in ui
edit.saveOneBtns = document.getElementsByClassName('edit-ui__save-one');
// save all button in ui
edit.saveAllBtn = document.getElementById('jsSaveAll');
edit.exportBtn = document.getElementById('jsPushToProd');
// import button in ui
edit.importBtn = document.getElementById('jsPullFromProd');
// keeps track of when to refresh ui when saving multiple data points
edit.saveMultipleTracker = 0;
// set to true when saving multiple data-points
edit.isMultipleSave = false;
edit.isEditWindowOpen = false;
edit.isUIOpen = false;

edit.showEditWindowAndMakeElementEditable = function(element){
  if(!edit.isEditWindowOpen){
    edit.getDataForOneDataPointForEditWindow(element);
    element.setAttribute('contenteditable', 'true');
    edit.isEditWindowOpen = true;
  }
}

edit.createEditWindow = function(element){
  // insert data into the template
  let populatedHTMLTemplate = edit.getDynamicHTMLForEditWindow(element);
  let editWindowContainer = edit.createEditWindowContainer();
  editWindowContainer.innerHTML = populatedHTMLTemplate;
  return editWindowContainer;
}

edit.getDynamicHTMLForEditWindow = function(element){
  let HTMLTemplate = `
  <p class="input-cont__title">${element.dataset.point}</p>
  <br>
  <input class="input-cont__save" type="submit" value="Save" id="jsSave" data-name="${element.dataset.point}">
  <input class="input-cont__close "type="button" value="Close" id="jsClose" data-name="${element.dataset.point}">
  `
  return HTMLTemplate;
}

edit.createEditWindowContainer = function(){
  let editWindowContainer = document.createElement('div');
  editWindowContainer.classList.add('input-cont');
  editWindowContainer.id = 'jsInputCont';
  if(edit.ui.classList.contains('edit-ui--active')){
    editWindowContainer.classList.add('input-cont--ui-open');
  }
  return editWindowContainer;
}

edit.addEventListenerToSaveButtonInTheEditWindow = function(){
  let saveBtn = document.getElementById('jsSave');
  saveBtn.addEventListener('click', function(){
    if(edit.isEditWindowOpen){
      let datapointName = this.dataset.name;
      edit.saveOneDataPointFromEditWindow(datapointName);
    }
  })
}

edit.addEventListenerToCloseButtonInTheEditWindow = function(){
  let closeBtn = document.getElementById('jsClose');
  closeBtn.addEventListener('click', function(){
    let editWindow = document.getElementById('jsInputCont');
    let editableElement = document.querySelector("[data-point='"+ closeBtn.dataset.name + "']");
    edit.closeEditWindow(editWindow);
    editableElement.setAttribute('contenteditable', 'false');
  })
}

edit.saveOneDataPointFromEditWindow = function(datapointName){
  let element = document.querySelector("[data-point='"+ datapointName + "']");
  if(element.innerHTML.length>0){
    edit.createAndExecuteAJAXCallToSaveOneDataPointFromEditWindow(element);
  } else {
    alert("Please enter a value");
  }
}
//TODO: extract ajax call from this function
//TODO: handle returned data
edit.createAndExecuteAJAXCallToSaveOneDataPointFromEditWindow = function(element){
  let ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  let value = "v=" + encodeURIComponent(element.innerHTML);
  let apiURLWithParameters = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=" + element.dataset.point + "&f=set";
  ajaxObject.onreadystatechange = function() {
    if (this.readyState == readyStateDone && this.status == statusOK) {
      element.innerHTML = this.response;
      edit.refreshUIWhenVisable();
    }
  };
  ajaxObject.open("POST", apiURLWithParameters, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send(value);
}

//TODO: extract ajax call from this function
//TODO: handle returned data
edit.createAndExecuteAJAXCallToSaveMultipleDataPointsFromUI = function(value, name, element){
  let ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  let encodedValue = "v=" + encodeURIComponent(value);
  let apiURLWithParameters = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=" + name + "&f=set";
  ajaxObject.onreadystatechange = function() {
    if (this.readyState == readyStateDone && this.status == statusOK) {
      element.innerHTML = this.response;
      if(!edit.isMultipleSave){
        edit.refreshUIWhenVisable();
        edit.isMultipleSave = false;
      }
      edit.saveMultipleTracker += 1;
      if(edit.saveMultipleTracker == edit.editableElements.length){
        edit.refreshUIWhenVisable();
        edit.saveMultipleTracker = 0;
      }
    }
  };
  ajaxObject.open("POST", apiURLWithParameters, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send(encodedValue);
}

edit.closeEditWindow = function(editWindow){
  edit.isEditWindowOpen = false;
  editWindow.remove();
}

edit.ActivateUIBtn.addEventListener('click', function(){
  edit.toggleUIVisability();
  edit.adjustWidthOfEditWindow();
})

edit.toggleUIVisability = function(){
  if(!edit.isUIOpen){
    edit.refreshUIWhenVisable();
    edit.isUIOpen = true;
  } else {
    edit.isUIOpen = false;
  }
  edit.ui.classList.toggle('edit-ui--active');
}

edit.adjustWidthOfEditWindow = function(){
  var editWindow = document.getElementById('jsInputCont');
  if(edit.isUIOpen && edit.isEditWindowOpen){
    editWindow.classList.add('input-cont--ui-open');
  } else if (edit.isEditWindowOpen && !edit.isUIOpen){
    editWindow.classList.remove('input-cont--ui-open');
  }
}
//TODO: extract ajax call from this function
//TODO: extract date logic from this function
//TODO: handle returned data
edit.getDynamicHTMLForUIInputs = function(dataPoint, pageDataPoints){
  let jsDate = new Date(pageDataPoints.stage[dataPoint + '_time']);
  let jsDateUnix = jsDate.getTime();
  let jsProdDate = new Date(pageDataPoints.prod[dataPoint + '_time']);
  let jsProdDateUnix = jsProdDate.getTime();
  let min = jsDate.getMinutes();
  if(min < 10){
    min = "0" + min;
  }
  // decide if data is older, never, same, or new
  if(jsDateUnix == jsProdDateUnix){
    var sync = "In Sync";
    var cl = "edit-ui__sync--sync"
  }else if(jsDateUnix > jsProdDateUnix){
    var sync = "Newer";
    var cl = "edit-ui__sync--newer"
  }else if(jsDateUnix < jsProdDateUnix){
    var sync = "Newer Available";
    var cl = "edit-ui__sync--old";
  } else {
    var sync = "New";
    var cl = "edit-ui__sync--new"
    if(!data){
      data = "";
    }
  }
  // insert data into the template
  return `
    <div class="edit-ui__input-cont">
    <div class="edit-ui__flex">
      <p class="edit-ui__label" data-pointUI="${dataPoint}">${dataPoint}</p><p class="edit-ui__sync ${cl}">${sync}</p>
    </div>
    <div class="edit-ui__accordion">
      <div class=edit-ui__info>
      </div>
      <textarea rows=5 type="textarea" class="edit-ui__input" data-pointUI="${dataPoint}" onkeyup="edit.adjustHeightOfTextAreaInUIOnChange(this)" style="overflow:y-hidden">${pageDataPoints.stage[dataPoint]}</textarea>
      <input type="submit" class="edit-ui__save-one" value="Save" data-pointUI="${dataPoint}">
    </div>
    </div>
  `
}

edit.adjustHeightOfTextAreaInUIOnChange = function(textArea) {
  textArea.style.height = "1px";
  textArea.style.height = (25+textArea.scrollHeight)+"px";
}

//TODO: extract ajax call from this function
edit.createAndExecuteAJAXCallToGetPageDataPointsHash = function(){
  var ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  let url = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=false" + "&f=getall";
  ajaxObject.onreadystatechange = function() {
  if (this.readyState == readyStateDone && this.status == statusOK) {
    var dataPointObject = this.response;
    edit.handleDataReturnedFromCreateAndExecuteAJAXCallToGetPageDataPointsHash(dataPointObject);
  }
  };
  ajaxObject.open("GET", url, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send();
}

edit.handleDataReturnedFromCreateAndExecuteAJAXCallToGetPageDataPointsHash = function(dataPointObject){
  var pageDataPoints = JSON.parse(dataPointObject);
  // build ui inputs
  for(let i=0, a=edit.editableElements, c=a.length;i<c;i++){
    let dataPoint = a[i].dataset.point;
    let HTMLTemplate = edit.getDynamicHTMLForUIInputs(dataPoint, pageDataPoints);
    var container = document.createElement('div');
    container.innerHTML = HTMLTemplate.trim();
    edit.UIInputContainer.appendChild(container);
  }
  edit.saveEventListeners();
}

//TODO: extract ajax call from this function
edit.getDataForOneDataPointForEditWindow = function(element){
  var ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  ajaxObject.onreadystatechange = function() {
    if (this.readyState == readyStateDone && this.status == statusOK) {
      edit.handleDataReturnedFromGetDataForOneDataPointForEditWindow(element);
    }
  };
  let url = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=" + element.dataset.point + "&f=get";
  ajaxObject.open("GET", url, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send();
}

edit.handleDataReturnedFromGetDataForOneDataPointForEditWindow = function(element){
  let editWindow = edit.createEditWindow(element);
  document.body.appendChild(editWindow);
  edit.addEventListenerToSaveButtonInTheEditWindow();
  edit.addEventListenerToCloseButtonInTheEditWindow();
}

edit.saveEventListeners = function(){
  edit.addEventListenerToSaveButtonsInUI();
  edit.addEventListenerToAccordionsInUI();
  edit.addEventListenerToInputContainersInUIToHightlightCurrentEdidatbleElement();
}

//TODO: clean up variable names and readability
edit.addEventListenerToSaveButtonsInUI = function(){
  edit.saveOneBtns = document.getElementsByClassName('edit-ui__save-one');
  for(let i=0,c=edit.saveOneBtns.length,a=edit.saveOneBtns;i<c;i++){
    a[i].addEventListener('click', function(){
      let element = document.querySelector("[data-point='"+ this.dataset.pointui + "']");
      edit.createAndExecuteAJAXCallToSaveMultipleDataPointsFromUI(this.previousSibling.previousSibling.value, this.dataset.pointui, element);
    })
  }
}

//TODO: clean up variable names and readability
//TODO: extract trim functionality to own function
edit.addEventListenerToAccordionsInUI = function(){
  for(let i=0, a=document.getElementsByClassName('edit-ui__flex'),c=a.length;i<c;i++){
    a[i].addEventListener('click', function(){
      var currentElementOpen = this.nextSibling.nextSibling.classList.contains('show')
      for(let j=0, a=document.getElementsByClassName('edit-ui__accordion'),c=a.length;j<c;j++){
        if(a[j].classList.contains('show')){
          a[j].classList.toggle('show');
          break;
        }
      }
      this.nextElementSibling.querySelector('textarea').innerHTML = this.nextElementSibling.querySelector('textarea').innerHTML.trim();
      if(!currentElementOpen){
        this.nextSibling.nextSibling.classList.toggle('show');
      }
    })
  }
}

//TODO: clean up variable names and readability and refactor
edit.addEventListenerToInputContainersInUIToHightlightCurrentEdidatbleElement = function(){
  for(let i=0, a=document.getElementsByClassName('edit-ui__flex'),c=a.length;i<c;i++){
    a[i].addEventListener('mouseover', function(){
      document.querySelector("[data-point='"+ this.firstChild.nextElementSibling.dataset.pointui + "']").classList.add('jsEdit--outline')
    })
  }
  for(let i=0, a=document.getElementsByClassName('edit-ui__flex'),c=a.length;i<c;i++){
    a[i].addEventListener('mouseleave', function(){
      document.querySelector("[data-point='"+ this.firstChild.nextElementSibling.dataset.pointui + "']").classList.remove('jsEdit--outline')
    })
  }
}

edit.saveAllBtn.addEventListener('click', function(){
  edit.clickAllSaveButtonsInUI();
})

//TODO: rewrite this to send all unchanged data points to backend as one object and exec in redis pipeline
edit.clickAllSaveButtonsInUI = function(){
  edit.saveOneBtns = document.getElementsByClassName('edit-ui__save-one');
  for(let i=0,c=edit.saveOneBtns.length,a=edit.saveOneBtns;i<c;i++){
    edit.isMultipleSave = true;
    a[i].click();
  }
}

//TODO: move all this functionality to its own function
edit.exportBtn.addEventListener('click', function(){
  var ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  let url = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=false&f=export";
  ajaxObject.onreadystatechange = function() {
    if (this.readyState == readyStateDone && this.status == statusOK) {
      edit.refreshUIWhenVisable();
    }
  };
  ajaxObject.open("GET", url, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send();
})


edit.importBtn.addEventListener('click', function(){
  edit.importDataFromCompanionDB();
})

//TODO: move ajax creation and call to own function
edit.importDataFromCompanionDB = function(){
  var ajaxObject = new XMLHttpRequest();
  let readyStateDone = 4;
  let statusOK = 200;
  let url = "wp-content/themes/global-theme-assets/content_builder/pageData.php?ns=" + edit.siteNameSpace + "&n=false&f=import";
  ajaxObject.onreadystatechange = function() {
    if (this.readyState == readyStateDone && this.status == statusOK) {
      window.location.reload();
    }
  };
  ajaxObject.open("GET", url, true);
  ajaxObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxObject.send();
}

edit.refreshUIWhenVisable = function(){
  while (edit.UIInputContainer.firstChild) {
    edit.UIInputContainer.removeChild(edit.UIInputContainer.firstChild);
  }
  edit.createAndExecuteAJAXCallToGetPageDataPointsHash();
}

edit.attachShowEditWindowEventListenersToEditableElements = function(){
  for(let i=0,c=edit.editableElements.length,arr = edit.editableElements;i<c;i++){
    arr[i].addEventListener('click', function(){
      edit.showEditWindowAndMakeElementEditable(this);
    })
  }
}

document.addEventListener('DOMContentLoaded', function(){ 
  edit.attachShowEditWindowEventListenersToEditableElements();
}, false);
