import React, { Component } from 'react'
import { connect } from 'react-redux'
import { Route } from 'react-router-dom'
import ListViewMain from './lists/list-main'
import GroupList from './lists/list-groups'
import NewsletterList from './lists/list-newsletter'

class ListView extends Component {
  render () {
    return (
      <div className="TourView text-center pt-3">
        <Route exact path="/utskick" component={ListViewMain} />
        <Route exact path="/utskick/gruppregister" component={GroupList} />
        <Route exact path="/utskick/nyhetsbrev" component={NewsletterList} />
      </div>
    )
  }
}

export default connect(null, null)(ListView)
