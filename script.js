const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileElem");
const browseBtn = document.getElementById("browse-btn");
const preview = document.getElementById("preview");
const statusDiv = document.getElementById("upload-status");

browseBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  fileInput.click();
});

fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    showPreview(file);
    uploadFile(file);
  }
});

dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dropArea.classList.add("hover");
});

dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("hover");
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  dropArea.classList.remove("hover");

  const files = e.dataTransfer.files;
  if (files.length > 0) {
    showPreview(files[0]);
    uploadFile(files[0]);
  }
});

function showPreview(file) {
  preview.innerHTML = "";

  if (file.type.startsWith("image/")) {
    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.onload = () => URL.revokeObjectURL(img.src);
    preview.appendChild(img);
  } else {
    const p = document.createElement("p");
    p.textContent = "Yüklenecek Dosya: " + file.name;
    preview.appendChild(p);
  }
}

function uploadFile(file) {
  const formData = new FormData();
  formData.append("yuklenen_dosya", file);

  fetch("upload.php", {
    method: "POST",
    body: formData,
  })
    .then(response => response.text())
    .then(result => {
      statusDiv.innerHTML = `<p style="color:green;"><strong>${result}</strong></p>`;
    })
    .catch(error => {
      statusDiv.innerHTML = `<p style="color:red;">Yükleme başarısız oldu.</p>`;
      console.error("Hata:", error);
    });
}
