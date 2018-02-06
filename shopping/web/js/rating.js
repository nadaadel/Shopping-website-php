
function change(id)
{

    var cname = document.getElementById(id).className;
    var ab = document.getElementById(id + "_hidden").value;

    document.getElementById(cname + "rating").value = ab;
    var t = document.getElementById(cname + "rating");
    console.log(t);

    for (var i = ab; i >= 1; i--)
    {
        document.getElementById(cname + i).src = "../images/star2.png";
    }
    var id = parseInt(ab) + 1;
    for (var j = id; j <= 5; j++)
    {
        document.getElementById(cname + j).src = "../images/star1.png";
    }
}