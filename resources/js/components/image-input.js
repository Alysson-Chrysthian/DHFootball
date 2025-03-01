const imagePickerButton = document.querySelector('.image-container');
const imageInput = document.querySelector('.image-input');

imagePickerButton.addEventListener('click', (e) => {
    imageInput.click();
})

imageInput.addEventListener('change', (e) => {
    if (!imageInput.files[0])
        return;

    const imageReader = new FileReader();

    imageReader.onload = () => {
        imagePickerButton.innerHTML = `<img src="${imageReader.result}" />`;
    }

    imageReader.readAsDataURL(imageInput.files[0]);
})