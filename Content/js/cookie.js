
function setJSEnabledCookie() {
    var cookieExpiryDate = new Date();
    cookieExpiryDate.setHours(cookieExpiryDate.getHours()+1);
    document.cookie="JSEnabled=1; expires="+cookieExpiryDate.toDateString()+"; path=/; ";
}