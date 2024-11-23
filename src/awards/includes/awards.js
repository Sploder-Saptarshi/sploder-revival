$().ready(function () {

	// wire up the awards
	$(document).find(".award_controls").find("a").click(onAwardClick);

	// wire up the chooser

	$("#memberRemote").autocomplete("/awards/findmembers.php", {
		width: 260,
		selectFirst: false
	});

	$("#memberRemote").result(function (event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});

	$("#memberRemote").result(onMemberSelect);

});

function onMemberSelect(event, data, formatted) {

	if ($("#suggest_" + data).length > 0) return;

	$("<li class=\"suggest\" id=\"suggest_" + data + "\">").html(!data ?
		"No friend found with that name!" :
		"You selected: <strong>" + formatted + "</strong> <a href=\"\">Make an award &raquo;</a>").appendTo("#result");

	$("#suggest_" + data).find("a").click(function () {

		$("#suggest_" + data).find("a").replaceWith("<span class=\"request\">Working...</span>");
		makeAward(data);

		return false;

	});

}

function makeAward(friendname) {

	window.location = "/awards/creator.php?membername=" + friendname;

}

function onAwardClick(e) {

	var action = e.target.innerHTML.toLowerCase();
	var award_id = parseInt(e.target.parentNode.parentNode.id.split("_")[1]);

	if (action.length > 0 && award_id > 0) {

		if (action == "revoke" && !confirm('Do you really want to revoke this award?')) return false;
		if (action == "decline" && !confirm('Do you really want to decline this award?')) return false;

		changeAward(action, award_id);

		$("#award_" + award_id).find("span").html("Working...");

	}

	return false;

}

function changeAward(action, award_id, friendname) {

	$.ajax({
		type: "GET",
		dataType: "text",
		url: "/awards/awards.php",
		data: "action=" + action + "&award_id=" + award_id,
		success: onChangeAwardResult,
		error: onAjaxError
	});

}

function onChangeAwardResult(data, textStatus) {

	var status = data.split("|")[0];
	var id = data.split("|")[1];
	var action = data.split("|")[2];

	if (status == "1") {

		switch (action) {

			case "accept":

				$("#award_" + id).html("<p>You have accepted this award!</p>");
				$("#award_" + id).addClass("result_success");
				break;

			case "decline":

				$("#award_" + id).html("<p>You have declined this award &hellip;</p>");
				$("#award_" + id).addClass("result_notice");
				$("#award_" + id).fadeOut(2000, function () {
					$(this).remove();
				});
				break;

			case "revoke":

				$("#award_" + id).html("<p>You have revoked this award &hellip;</p>");
				$("#award_" + id).addClass("result_notice");
				$("#award_" + id).fadeOut(2000, function () {
					$(this).remove();
				});
				break;

			case "delete":

				$("#award_" + id).find("span").html("Deleted!");
				$("#award_" + id).addClass("result_notice");
				break;

			case "undelete":

				$("#award_" + id).find("span").html("Undeleted!");
				$("#award_" + id).addClass("result_success");
				break;

		}

	}

}

function onAjaxError(XMLHttpRequest, textStatus, errorThrown) {
	$("#rpc_messages").html("<p class=\"alert\">There is an error in the awards module.  Sorry!</p>");
}
