// component that contains all the logic and other smaller components
// that form the Read Products view
class ReadProductsComponent extends React.Component {

    constructor(props) {
			
        super(props);
        this.state = {products:[]};
	console.log('2222222222222222');
		
    }
 
    // on mount, fetch all products and stored them as this component's state
    componentDidMount() {

      //  var base_url = $('#base_url').val();
        this.serverRequest = $.get("http://www.espace.com/product/all", function (res) {
				
            this.setState({
                products: $.parseJSON(res),
            });
        }.bind(this));
    }
    // on unmount, kill product fetching in case the request is still pending
    componentWillUnmount() {
		
		
        this.serverRequest.abort();
    }

    // render component on the page
    render() {
            
        var filteredProducts = this.state.products;
         console.log(filteredProducts);
     //  $('.page-header h1').text('Product List');
        
        return (
            <div className='overflow-hidden'>
                <TopActionsComponent changeAppMode={this.props.changeAppMode} />
				<ProductsTable
                    products={filteredProducts}
                   changeAppMode={this.props.changeAppMode} />
			
               
            </div>
        );
    }
}