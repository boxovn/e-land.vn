// component for the whole products table
class ProductsTable extends React.Component {

    constructor(props) {
        super(props);
       
        console.log(this.props);
        this.state = {products: []};
        
            this.handleResultChange = this.handleResultChange.bind(this);
 
    }

    componentWillReceiveProps(nextProps) {
		 console.log(nextProps);
		  console.log('99999999999999');
        // console.log(nextProps.products);
        this.setState({products: nextProps.products});
    }
	 handleResultChange(data) {
		 console.log('vvvvvvvvvvvvvvvvv');
			console.log(data);
			this.setState({
			  data,
			});
	}

    render() {
		
		 
        const p = this.state.products;
		var rows = $.map(p,function(product, i) {
             return (
                <ProductRow key={i} product={product} changeAppMode={this.props.changeAppMode} />
            );
        }.bind(this)); 

        return(
                <table className='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price($)</th>
                            <th className='action-column'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
					{rows}
                    </tbody>
                </table>
        );
        
        
    }
}