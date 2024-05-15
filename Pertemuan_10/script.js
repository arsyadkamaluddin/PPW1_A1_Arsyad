const tabel = document.querySelector("#tabel")
const judul = document.querySelector("h1")
function tampilAlert(){
    alert("Kamu pencet alert")
}
function tambahTeks(){
    teks = prompt("Mau nambahin siapa ?")
    umur = prompt("Berapa umurnya ?")
    tabel.innerHTML += `<tr><td>${teks}</td><td>${umur}</td></tr>`
}
function cetakKonsol(){
    console.log("Haii")
}
function gantiJudul(){
    teks = prompt("Ganti apa ?")
    judul.innerHTML = teks
}
function clearPage(){
    yakin = confirm("Yakin membersihkan halaman ?")
    if(yakin)document.write("<h1>SELESAI</h1>")
}