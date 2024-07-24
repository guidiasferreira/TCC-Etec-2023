const inputFile = document.querySelector("#input");
const pictureImage = document.querySelector(".pictureImage");
const pictureImageTxt = "<p>Inserir Imagem</p>";
pictureImage.innerHTML = pictureImageTxt;
inputFile.addEventListener("change", function (e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];
    if (file) {
        const reader = new FileReader();
        reader.addEventListener("load", function (e) {
            const readerTarget = e.target;
            const img = document.createElement("img");
            img.src = readerTarget.result;
            img.classList.add("pictureImg");
            pictureImage.innerHTML = "";
            pictureImage.appendChild(img);
            pictureImage.style.alignItems = "initial";
        });
        reader.readAsDataURL(file);
    }
    else {
        pictureImage.innerHTML = pictureImageTxt;
        pictureImage.style.alignItems = "center";
    }
});
const b = document.querySelector(".button");
const m = document.querySelector("main");
const s = document.querySelector(".sidebar");
b.addEventListener('click', () => {
    s.classList.toggle("b");
    s.classList.toggle("sidebar");
    m.classList.toggle("active");
})