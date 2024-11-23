<script>
onload2()
</script>
<div class="online_box">
    <h3>Who's Online Now.
        <span style="color: #999; font-size: 12px;">[Top 15]</span>
    </h3>
    <div id="whos_online_container">
        <p style="color: #666;">
            <img src="../images/loading_icon.gif" width="24" height="12"> Checking members...
        </p>
    </div>

</div>
<script type="text/javascript">
window.onload = function() {
    var n;
    n = document.createElement('link');
    n.rel = 'stylesheet';
    n.type = 'text/css';
    n.href = '../css/venue5.css';
    document.getElementsByTagName('head')[0].appendChild(n);
    n = document.createElement('script');
    n.type = 'text/javascript';
    n.src = 'https://web.archive.org/web/20140608214730/http://sploder.us/dashboard6.js';
    document.getElementsByTagName('head')[0].appendChild(n);
    if (onload2) onload2();
}
onload2 = function() {
    var n;
    n = document.createElement('link');
    n.rel = 'stylesheet';
    n.type = 'text/css';
    n.href = '../css/users2.css';
    document.getElementsByTagName('head')[0].appendChild(n);
    n = document.createElement('script');
    n.type = 'text/javascript';
    n.src = '../php/onlinelist.php';
    document.getElementsByTagName('head')[0].appendChild(n);
}
if (window.onload == null) window.onload = onload2;
</script>