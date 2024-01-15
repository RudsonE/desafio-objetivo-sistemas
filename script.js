const ttal = document.getElementById('total');
const sValue = document.getElementById("second-value");
const desc = document.getElementById('desc');
const val = document.getElementById('val');
const quant = document.getElementById("quant");
const qua = document.getElementById("qua");

desc.addEventListener('input', ()=> calcDesc())
qua.addEventListener('input', ()=> calcDesc())

function calcDesc(){
    let calc = qua.value * (val.innerText - (val.innerText * (desc.value / 100)));
    ttal.value = calc.toFixed(2)
    sValue.innerText = calc.toFixed(2)
}

function abreLink(link){
    window.location.href = link
}

function getQuant(){
    qua.setAttribute('max', quant.innerText)
}

window.onload = ()=>{
    getQuant();
    calcDesc();
}