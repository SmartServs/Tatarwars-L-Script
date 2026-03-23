function checkedAll(name)
{
    checkboxes = document.getElementsByName(name);
    for(var i=0, n=checkboxes.length;i<n;i++)
    {
        checkboxes[i].checked = checkboxes[i].checked ? false : true;
   	}
}
function KMBTBInfo()
{
    alert("K = 1,000\nM = 1,000,000\nB = 1,000,000,000\n TB = 1,000,000,000,000\n\n Example: \n 10K = 10,000 \n 10M = 10,000,000 \n 10B = 10,000,000,000\n 10TB = 10,000,000,000,000 ");
}

if(Notification.permission !== 'denied')
{
    Notification.requestPermission(function (permission) {});   
}
function notifyMe(title, body)
{
    if (!("Notification" in window))
    {
        return 0;
    }
    else if (Notification.permission === "granted")
    {
        var notification = new Notification(title, { body: body, icon: "assets/favicon.ico" });
    }
}