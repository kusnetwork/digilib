if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.mymodal = {

	startMyModal: function()
	{
		var handler = $.proxy(function()
		{
			this.saveSelection();
		
			$('#redactor_modal #mymodal-link').click($.proxy(function()
			{
				this.insertFromMyModal();					
				return false;
					
			}, this));
		}, this);
	
		this.addBtn('mymodal', 'My Modal', function(obj)
		{
			obj.modalInit('My Modal', '#mymodal', 500, handler);			
		});	
		
		this.addBtnSeparatorBefore('mymodal');
			
	},
	insertFromMyModal: function(html)
	{
		this.restoreSelection();
		this.execCommand('inserthtml', '<b>Inserted from My Modal</b>');
		this.modalClose();
	}

}