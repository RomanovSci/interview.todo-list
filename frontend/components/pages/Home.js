import React, {Component} from 'react';

export default class Home extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-1">
                        <h1>Tasks</h1>
                    </div>
                </div>
            </div>
        );
    }
}