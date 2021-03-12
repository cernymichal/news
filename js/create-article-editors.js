ClassicEditor.create(document.querySelector("#inputPerex"), {
  toolbar: ["bold", "italic", "link"],
}).catch((error) => {
  console.log(error);
});

ClassicEditor.create(document.querySelector("#inputText")).catch((error) => {
  console.error(error);
});
