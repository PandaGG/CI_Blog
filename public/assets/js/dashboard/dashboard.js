/*! Dashboard Javascript */
$(function(){
	bindSidebarSwitch();
});

function bindSidebarSwitch(){
	$('.menu-header').click(function(){
		$('.dashboard-body').toggleClass('sidebar-full');
	});
}