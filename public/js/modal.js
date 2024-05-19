// modal 
const modalDiv = document.getElementById('modal')

// アニメーションの場合
const modalOpenFrames = {
    opacity:[0, 1],
    display:['none','block'],
}

const modalCloseFrames = {
    opacity:[1, 0],
    display:['block', 'none'],
}

const options = {
    duration: 600,
    easing: 'ease'
}

// クリックで動作する関数 確認はまだ
const modalOpen = () => {
    modalDiv.style.opacity = 1
    modalDiv.style.display = 'block'
}

const modalCloseButton = document.getElementById('modalClose')

const modalCloseFunction = () => {
    modalDiv.style.displey = 'none'
    modalDiv.style.opacity = 0
}

modalCloseButton.addEventListener('click', modalCloseFunction)