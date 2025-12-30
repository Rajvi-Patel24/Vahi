async function uploadImage() {
  const fileInput = document.getElementById("imageInput");
  const status = document.getElementById("status");
  const result = document.getElementById("result");

  if (!fileInput.files.length) {
    alert("Please select an image");
    return;
  }

  const formData = new FormData();
  formData.append("image", fileInput.files[0]);

  status.innerText = "Extracting data...";
  result.innerText = "";

  try {
    const res = await fetch("extract.php", {
      method: "POST",
      body: formData
    });

    const data = await res.json();

    if (data.success) {
      status.innerText = "Extraction Successful ✅";
      result.innerText = JSON.stringify(data.data, null, 2);
    } else {
      status.innerText = "Extraction Failed ❌";
      result.innerText = data.error;
    }
  } catch (err) {
    console.error(err);
    status.innerText = "Server Error ❌";
  }
}
