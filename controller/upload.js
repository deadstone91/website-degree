function validateArticle()
{
    if($("#Title").includes("<") || $("#Title").includes(">"))
    {
        alert("use of html tag symbols not allowed");
        return false;

    }

    if($("#description").includes("<") || $("#description").includes(">"))
    {
        alert("use of html tag symbols not allowed");
        return false;

    }

    if($("#text").includes("<") || $("#text").includes(">"))
    {
        alert("use of html tag symbols not allowed");
        return false;

    }
}
