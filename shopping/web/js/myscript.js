$(document).ready(function () {
 //Auto Complete for search   
    $("#search-box").keyup(function () {
        $.ajax({
            type: "POST",
            url: "search.php",
            data: 'keyword=' + $(this).val(),
            success: function (data) {
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background", "#FFF");
            }
        });
    });

// remove from cart
   $(".proCheck").on("click", ".rmBtn", function (event) {      
        reid =  $(".proCheck").find(this).attr("name");
        oldPrice = $("#priceText").html();
        prodPrice =  $(".proCheck").find(this).attr("proPrice");
        console.log(prodPrice);
        NewPrice = oldPrice - prodPrice;
         $("#priceText").html(NewPrice);
        console.log(reid);
        var datar = {rid: reid , actionR: "remove"}; 
        $.ajax({
            type: "POST",
            url: "search.php",
            data: datar
        });
        $(this).parent().remove();
    });
    
    //add to cart Ajax Request
    $(".categories").on("click", ".addToCart", function (event) {
        if($(".categories").find(this).val() !== "in Cart"){
             $(".categories").find(this).val("in Cart");
        proId =  $(".categories").find(this).attr("name");
        console.log(proId);
        var dataString = {id: proId ,actionT: "add"};
        $.ajax({
            type: "POST",
            url: "search.php",
            data: dataString
           
        });
        }
    
    });

});

//To select country name
function selectCountry(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
   
    
}
