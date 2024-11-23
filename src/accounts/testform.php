<div class="textform">
    <form name="form" action="https://www.sploder.com/accounts/register" method="post" onsubmit="return CheckData()">
        <table cellpadding="4">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" id="username" class="username_input"
                        placeholder="Not your real name..." autocomplete="off" autocorrect="off" autocapitalize="off"
                        spellcheck="false" maxlength="16" autocapitalize="off" autocorrect="off" value=""
                        onkeyup="checkUsername();" /></td>
                <td><img valign="middle" id="usernamecheck"
                        src="/web/20170908201609im_/https://www.sploder.com/images/idle-user.png" width="20"
                        height="20" /> 3-16 characters.</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td colspan="2"><input type="password" name="pass1" placeholder="At least 8 letters or numbers..."
                        maxlength="25" /></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td colspan="2"><input type="password" name="pass2" placeholder="Enter your password again..."
                        maxlength="25" /></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <p>Your email address is not stored on Sploder.
                        It is only used to generate a key to reset your password. If you are under 13 years of age,
                        you must use your parent's email address to sign up.</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td colspan="2"><input type="email" name="email" placeholder="Enter your email address..."
                        maxlength="60" value="" /></td>
            </tr>
            <tr>
                <td>Confirm Email Address</td>
                <td colspan="2"><input type="email " name="email2" placeholder="Enter your email again..."
                        maxlength="60" value="" /></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="checkholder">
                        <input name="social" type="checkbox" class="checkbutton" value="1" checked="checked" />
                    </div>
                    <p>Allow comments and friending on my profile.</p>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="checkholder">
                        <input name="tostest" type="checkbox" class="checkbutton" value="1" />
                    </div>
                    <p>I agree to abide by the <a href="termsofservice.php" target="_blank">terms of service</a>,
                        and I understand that if I am under the age of 13 I must enter the email address of a
                        parent or guardian and not use my own email address.</p>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="recaptcha">
                    <div>
                        <div class="g-recaptcha" data-sitekey="6LcWqcUSAAAAAM__li0_i_Ay4LsT_qME5auyVpBl"
                            data-theme="dark"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr />
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <input type="submit" name="Submit" class="postbutton" value="?  Register " /> &nbsp; &nbsp; &nbsp;
                    <input type="reset" name="Reset" class="postbutton" value="Reset" />
                </td>
            </tr>
        </table>
    </form>