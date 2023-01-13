$(".member--figureItem-inputClear").click(function(){
    var input = $(this).closest(".member--figureItem-inputBox").find("input")
    input.val('')
})
document.getElementById("formReset").addEventListener('click', () => {
    var el = document.getElementsByTagName("input")
    for(let i = 0; i<el.length; i++){
        el[i].value = '';
    }
})