const ttal = document.getElementById('total');
const desc = document.getElementById('desc');
const val = document.getElementById('val');

desc.addEventListener('input', ()=>{
    ttal.innerHTML = val.innerText - (val.innerText * (desc.value / 100));
})

function abreLink(link){
    window.location.href = link
}

