import React from 'react';
import {
    Router,
    Route,
    RouterState,
    IndexRoute,
    hashHistory
} from 'react-router';
import Layout from './Layout';

/** Pages */
import Home from './components/pages/Home';
import NotFound from './components/pages/NotFound';

/** Router */
export default <Router history={hashHistory}>
    <Route path="/" component={Layout}>
        <IndexRoute component={Home}/>

        <Route path="*" component={NotFound}/>
    </Route>
</Router>;