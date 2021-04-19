$(function(){
    $("#frm-moeda").on('submit', function(e){
        e.preventDefault();
        let moeda = $("#moeda").val()
        if(!moeda)
        return false

        $.ajax({
            type: "get",
            url: `convert/${moeda}`,
            dataType: "html",
            success: function (response) {
                document.querySelector("#return-cotacao").innerHTML = response
            }
        });
    })
})
