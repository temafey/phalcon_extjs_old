Ext.define('Ext.ux.crud.Filter', {
    extend: 'Ext.form.Panel',

    requires: ['Ext.form.Panel','Ext.form.field.*'],

    initComponent : function() {
        this.callParent();
    },

    onReset: function() {
        var me = this;

        var fields = me.getForm().getFields().items;
        for (var i = 0, len = fields.length; i < len; i++) {
            fields[i].reset();
        }
    },

    onClear: function() {
        var me = this;
        me.onReset();
    },

    onSubmit: function() {
        var me = this;

        if (me.getForm().isValid()) {
            var values = me.getForm().getValues();
            var params = {};
            for (var key in values) {
                if (values[key] === '') {
                    continue;
                }
                params[key] = values[key];
            }
            me.fireEvent('onSubmit', me, params);
        }
    },

    rtrim: function (str, charlist) {
        charlist = !charlist ? ' \s\u00A0' : (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+$\^\:])/g, '\$1');
        var re = new RegExp('[' + charlist + ']+$', 'g');
        return (str + '').replace(re, '');
    }

});