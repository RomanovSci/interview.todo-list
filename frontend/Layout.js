import './styles/main.scss';
import React, {Component} from 'react';

export default class Layout extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isLoggedIn: false,
        }
    }

    renderNavigation() {
        return (
            <nav className="navbar navbar-light bg-faded">
                <a className="navbar-brand" href="/">Home</a>
                <a className="navbar-brand" href="#/login">Login</a>
            </nav>
        );
    }

    render() {
        return (
            <div className="wrapper">
                {this.renderNavigation()}
                <div id="content">
                    {this.props.children}
                </div>
            </div>
        );
    }
};