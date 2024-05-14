// modal 
const modalDiv = document.getElementById('modal')

const modalOpenFunctoion = () => {
    modalDiv.style.opacity = 1
    modalDiv.style.display = 'block'
}

const modalCloseButton = document.getElementById('modalClose')

const modalCloseFunction = () => {
    modalDiv.style.displey = 'none'
    modalDiv.style.opacity = 0
}

modalCloseButton.addEventListener('click', modalCloseFunction)