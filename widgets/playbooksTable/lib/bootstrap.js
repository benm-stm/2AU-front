$(document).ready(function() {
 $.ajax({
                url: 'widgets/playbooksTable/main.php',
		data: "",
		type: 'POST',
		success: function(playbook_list) {
			$("#playbooks_list").append(playbook_list);
		}
        });
});
