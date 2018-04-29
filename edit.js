var edit = {};

// // site vars
edit.siteNameSpace = 'offer_sprint_com:pages:iphone';
edit.els = document.getElementsByClassName('jsEdit');
edit.open = false;

// functions
for(let i=0,c=edit.els.length,arr = edit.els;i<c;i++){
  arr[i].addEventListener('click', function(){
    edit.showEditInput(this);
  })
}

edit.showEditInput = function(el){
  if(!edit.open){
    let inputCont = edit.createEditInput(el);
    document.body.appendChild(inputCont);
    edit.addSaveEvent();
  }
}

edit.createEditInput = function(el){
  let inputCont = document.createElement('div');
  inputCont.classList.add('input-cont');
  let label = document.createElement('p');
  label.innerText = el.dataset.point;
  let input = document.createElement('input');
  input.type = 'textarea';
  input.id = 'jsInput';
  let save = document.createElement('input');
  save.type = 'submit';
  save.value = 'Save';
  save.id = 'jsSave';
  save.setAttribute('data-name', el.dataset.point);
  inputCont.appendChild(label);
  inputCont.appendChild(input);
  let br = document.createElement('br');
  inputCont.appendChild(br);
  inputCont.appendChild(save);
  let pos = el.getBoundingClientRect();
  inputCont.style.top = pos.bottom + 5 + 'px';
  inputCont.style.left = pos.left + 'px';
  edit.open = true;
  return inputCont;
}

edit.addSaveEvent = function(){
  let saveBtn = document.getElementById('jsSave');
  saveBtn.addEventListener('click', function(){
    edit.saveDataPoint(this);
  })
}

edit.saveDataPoint = function(el){
  let input = document.getElementById('jsInput');
  let value = input.value;
  if(value.length>0){
    let name = el.dataset.name;
    edit.sendAjaxRequest(edit.siteNameSpace, value, name, "set");
  } else {
    alert("Please enter a value");
  }
}

edit.sendAjaxRequest = function(ns, v, n, f){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.response);
    }
  };
  let url = "/pageData.php?ns=" + ns + "&v=" + v + "&n=" + n + "&f=" + f;
  xhttp.open("GET", url, true);
  xhttp.send();
}

