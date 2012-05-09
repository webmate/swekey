/**
 * This is a replacement for the default implementation and it uses Mootools to perform ajax requests
 */

function swekey_ajax_caller(xparams, cb)
{
	// add hook events
	window.fireEvent('swekeyAjax_beforeRequest', [xparams, cb]);
	
	xparams.REQUEST_TOKEN = REQUEST_TOKEN;
	xparams.swekey_ajax = true;
	
	new Request({
		url: window.location.href,
		data: Object.toQueryString(xparams),
		onComplete: function(result)
		{
			var json = JSON.decode(result);
			
			// add hook events
			window.fireEvent('swekeyAjax_afterRequest', [xparams, cb, json.content]);

			// update the token
			REQUEST_TOKEN = json.token;

			try
			{
				// callback is not mandatory
				if (cb)
				{
					cb(json.content);
				}
			}
			catch (e)
			{
				alert("swekey ajax exception: '" + json.content + "' " + e);
			}
		}
	}).send();
}


/**
 * Disable the user login form
 */
window.addEvent('swekeyAjax_afterRequest', function(params, callback, response)
{
	if (params.action != 'swekey_validate')
	{
		return;
	}

	// only do that for the login page
	if (!$$('form.tl_login_form')[0].getElements('table.tl_login_table')[0].getElements('input[name="username"]')[0])
	{
		return;
	}
	
	if (response.user_name)
	{
		$('username').setProperty('readonly', 'readonly');
		$('username').setStyle('background-color', '#CCCCCC');
	}
});

/**
 * Enable the user login form
 */
window.addEvent('swekeyAjax_afterRequest', function(params, callback, response)
{
	if (params.action != 'unplugged')
	{
		return;
	}

	// only do that for the login page
	if (!$$('form.tl_login_form')[0].getElements('table.tl_login_table')[0].getElements('input[name="username"]')[0])
	{
		return;
	}
	
	$('username').removeProperty('readonly');
	$('username').setStyle('background-color', '#FFFFFF');
	$('username').set('value', '');
});


/**
 * Redirect the user to main.php
 */
window.addEvent('swekeyAjax_afterRequest', function(params, callback, response)
{
	if (params.action != 'attach_swekey')
	{
		return;
	}

	// only redirect if successful
	if (response.error == null)
	{
		window.location.href = window.location.href.replace('system/modules/swekey/SwekeyController.php', 'contao/main.php');
	}
});