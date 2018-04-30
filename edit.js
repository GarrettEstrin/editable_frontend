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
    edit.addSaveEvent(inputCont);
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
  input.value = el.innerText;
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
  let close = document.createElement('input');
  close.type = 'button';
  close.value = 'Close';
  close.id = "jsClose";
  inputCont.appendChild(close);
  return inputCont;
}

edit.addSaveEvent = function(inputCont){
  let saveBtn = document.getElementById('jsSave');
  let closeBtn = document.getElementById('jsClose');
  saveBtn.addEventListener('click', function(){
    edit.saveDataPoint(this);
  })
  closeBtn.addEventListener('click', function(){
    edit.closeInputCont(inputCont);
  })
}

edit.saveDataPoint = function(el){
  let input = document.getElementById('jsInput');
  let value = input.value;
  let element = document.querySelector("[data-point='"+ el.dataset.name + "']");
  if(value.length>0){
    let name = el.dataset.name;
    edit.sendAjaxRequest(edit.siteNameSpace, value, name, "set", element);
  } else {
    alert("Please enter a value");
  }
}

edit.sendAjaxRequest = function(ns, v, n, f, el){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(f = "set"){
        el.innerText = this.response;
      }
    }
  };
  let url = "./pageData.php?ns=" + ns + "&v=" + v + "&n=" + n + "&f=" + f;
  xhttp.open("GET", url, true);
  xhttp.send();
}

edit.closeInputCont = function(inputCont){
  edit.open = false;
  inputCont.remove();
}
