$(function(){
  window.Todo = Backbone.Model.extend({
    // Default attributes for the todo item.
    defaults: function() {
      return {
        title: "empty todo...",
        done: false
        // order: Todos.nextOrder(),
      };
    },

     // Toggle the `done` state of this todo item.
    toggle: function() {
        this.save({done: !this.get("done")});
    },

    clear: function() {
        this.destroy();
    }

  });


  window.TodoList = Backbone.Collection.extend({
        // Reference to this collection's model.
        model: Todo,
        url:"/=/todos",
        done: function() {
            return this.filter(function(todo){ return todo.get('done'); });
        },
        remaining: function() {
            return this.without.apply(this, this.done());
        },
  });


// Create our global collection of **Todos**.
window.Todos = new TodoList;

    var TodoView = Backbone.View.extend({
        tagName:  "li",
        template: _.template($('#item-template').html()),
        events: {
            "click .toggle"   : "toggleDone",
            // "dblclick .view"  : "edit",
            // "click a.destroy" : "clear",
            // "keypress .edit"  : "updateOnEnter",
            // "blur .edit"      : "close"
        },

        // Re-render the titles of the todo item.
        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            this.$el.toggleClass('done', this.model.get('done'));
            this.input = this.$('.edit');
            return this;
        },

        // Toggle the `"done"` state of the model.
        toggleDone: function() {
        this.model.toggle();
        },

        // Switch this view into `"editing"` mode, displaying the input field.
        edit: function() {
        this.$el.addClass("editing");
        this.input.focus();
        },

        // Close the `"editing"` mode, saving changes to the todo.
        close: function() {
        var value = this.input.val();
        if (!value) this.clear();
        this.model.save({title: value});
        this.$el.removeClass("editing");
        },

        // If you hit `enter`, we're through editing the item.
        updateOnEnter: function(e) {
        if (e.keyCode == 13) this.close();
        },

        // Remove the item, destroy the model.
        clear: function() {
        this.model.clear();
        }

    });

    var AppView = Backbone.View.extend({

            // Instead of generating a new element, bind to the existing skeleton of
            // the App already present in the HTML.
            el: $("#todoapp"),

            // Our template for the line of statistics at the bottom of the app.
            statsTemplate: _.template($('#stats-template').html()),

            // Delegated events for creating new items, and clearing completed ones.
            events: {
                "keypress #new-todo":  "createOnEnter",
                "click #clear-completed": "clearCompleted",
                "click #toggle-all": "toggleAllComplete"
            },

            // At initialization we bind to the relevant events on the `Todos`
            // collection, when items are added or changed. Kick things off by
            // loading any preexisting todos that might be saved in *localStorage*.
            initialize: function() {

                this.input = this.$("#new-todo");
                this.allCheckbox = this.$("#toggle-all")[0];

                Todos.bind('add', this.addOne, this);
                Todos.bind('reset', this.addAll, this);
                Todos.bind('all', this.render, this);

                this.footer = this.$('footer');
                this.main = $('#main');

                Todos.fetch();
            },

            // Re-rendering the App just means refreshing the statistics -- the rest
            // of the app doesn't change.
            render: function() {
                var done = Todos.done().length;
                var remaining = Todos.remaining().length;

                if (Todos.length) {
                    this.main.show();
                    this.footer.show();
                    this.footer.html(this.statsTemplate({done: done, remaining: remaining}));
                } else {
                    this.main.hide();
                    this.footer.hide();
                }

                this.allCheckbox.checked = !remaining;
            },

            // Add a single todo item to the list by creating a view for it, and
            // appending its element to the `<ul>`.
            addOne: function(todo) {
                var view = new TodoView({model: todo});
                this.$("#todo-list").append(view.render().el);
            },

            // Add all items in the **Todos** collection at once.
            addAll: function() {
                Todos.each(this.addOne);
            },

            // If you hit return in the main input field, create new **Todo** model,
            // persisting it to *localStorage*.
            createOnEnter: function(e) {
                if (e.keyCode != 13) return;
                if (!this.input.val()) return;

                Todos.create({title: this.input.val()});
                this.input.val('');
            },

            // Clear all done todo items, destroying their models.
            clearCompleted: function() {
                _.each(Todos.done(), function(todo){ todo.clear(); });
                return false;
            },

            toggleAllComplete: function () {
                var done = this.allCheckbox.checked;
                Todos.each(function (todo) { todo.save({'done': done}); });
            }
    });

    var App = new AppView;
});
