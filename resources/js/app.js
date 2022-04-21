import './bootstrap'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import { ThemeProvider } from 'styled-components'
import 'typeface-merriweather'
import 'typeface-lato'
import { UserProvider } from './components/User'
import theme from './helpers/theme'
import Home from './layouts/Home'
import DogEntry from './layouts/DogEntry'
import ReaderEntry from './layouts/ReaderEntry'
import ReaderLog from './layouts/ReaderLog'
import VolunteerInfo from './layouts/VolunteerInfo'
import VolunteerLog from './layouts/VolunteerLog'
import VolunteerVisit from './layouts/VolunteerEntry'
import SiteContainer from './components/SiteContainer'
import Footer from './components/akc-org/Footer'
import Header from './components/akc-org/Header'
import { H1 } from './components/Headings'
import Title from './components/Title'
import ProtectedRoute from './components/ProtectedRoute'

class App extends Component {
  render () {
    return (
      <ThemeProvider theme={theme}>
        <UserProvider>
          <SiteContainer>
            <Header />
            <Title>
              <H1>AKC's Reading Program</H1>
            </Title>
            <BrowserRouter>
              <Switch>
                <ProtectedRoute path='/readerlog' component={ReaderLog} />
                <ProtectedRoute path='/readerentry' component={ReaderEntry} />
                <ProtectedRoute path='/volunteerlog' component={VolunteerLog} />
                <ProtectedRoute path='/volunteerentry' component={VolunteerVisit} />
                <ProtectedRoute path='/volunteerinfo' component={VolunteerInfo} />
                <ProtectedRoute path='/dogentry' component={DogEntry} />
                <Route path='/' component={Home} />
              </Switch>
            </BrowserRouter>
            <Footer />
          </SiteContainer>
        </UserProvider>
      </ThemeProvider>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'))

if (process.env.NODE_ENV === 'development' && module.hot) {
  module.hot.accept()
}
