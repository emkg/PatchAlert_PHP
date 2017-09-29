<?php require('top.php'); ?>
<?php require('db_ops.php'); ?>
<!-- main content -->
<div class='page-container'>
  <form method='POST' name='change' id='change' action='createChange_submit.php' enctype='multipart/form-data'>
	  <h3>Request a change:</h3>
	  <p>What is the justification for why the request is being made, 
	  including any alternative approaches that were considered, 
	  and the implications of not making the change?</p>
	  <br/>
	  <textarea type='text' rows='4' name='reason'></textarea> <br/>
	  What servers will be affected? <br/><br/>
      <div id="multi-select-container" name="server-select"></div> 
	  <br/>
	  What additional resources and/or costs will be required, if any?
	  <br/><br/>
	  <textarea type='text' name='resources' rows='4'></textarea> <br/>
	  <input type='text' name='user' placeholder='Your name:'/>
	  <br/>
	<div class='button' >
        <a class='button-text' onClick="document.change.submit()">SUBMIT</a>
	</div>
  </form>
</div>
<!-- end main content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.5.1/core.min.js"></script>
<script src="https://unpkg.com/react@15.6.0/dist/react.min.js"></script>
<script src="https://unpkg.com/react-dom@15.6.0/dist/react-dom.min.js"></script>
<script>
    var e = React.createElement;

    var MultiSelect = React.createClass({
        propTypes: {
            name: React.PropTypes.string,
            options: React.PropTypes.arrayOf(React.PropTypes.shape({
                name: React.PropTypes.string,
                id: React.PropTypes.string
            }))
        },

        getInitialState: function () {
            return {
                selected: []
            };
        },

        attachAvailableRef: function (x) {
            this.available = x;
        },

        attachSelectedRef: function (x) {
            this.selected = x;
        },

        onAdd: function () {
            var options = this.props.options;
            var selected = this.state.selected;

            if (this.available) {
                var toAdd = Array.from(this.available.selectedOptions).map(
                    function (x) { return options.find(function (o) { return o.id === x.value; }); }
                );
                this.setState({
                    selected: ([].concat(selected).concat(toAdd)).filter(Boolean)
                });
            }
        },

        onRemove: function () {
            var selected = this.state.selected;

            if (this.selected) {
                var toRemove = Array.from(this.selected.selectedOptions).map(
                    function (x) { return selected.find(function (o) {return o.id === x.value;}); }
                );
                this.setState({
                    selected: selected.filter(function (x) { return x && !toRemove.includes(x);})
                });
            }
        },

        render: function () {
            var name = this.props.name;
            var options = this.props.options;
            var selected = this.state.selected;

            var available = options.filter(function (x) { return !selected.includes(x);});

            return e('div', {},
                e('select', {multiple: true, ref: this.attachAvailableRef},
                    available.map(function (x) { return e('option', {key: x.id, value: x.id}, x.name); })),

               
                e('select', {id: 'added' , name: 'servers[]', multiple: true, selected: true, ref: this.attachSelectedRef},
                    selected.map(function (x) { return e('option', {key: x.id, value: x.id, name: 'server'}, x.name); })),
                e('div', {id: 'add', onClick: this.onAdd}, 'add'),
                e('div', {id: 'rm', onClick: this.onRemove},'remove'),
                

                selected.map(function (x) {
                    return e('input', {type:'hidden', key: x.id, value: x.id, name: 'server[]'});
                })
            );
        }
    });

    <?php 
        $options = "[ "; 
        foreach($server_list as $s) {  
            $options .= " { name: '$s[name]', id: '$s[name]' },"; 
        } 
        
        $options .= " ]"; 
    ?>
    var options = <?php echo( $options ) ?>

    ReactDOM.render(e(MultiSelect, { options: options }), document.getElementById('multi-select-container'));

</script>

<?php require('bottom.php'); ?>