import { combineReducers } from 'redux'
import login from '../reducers/login'
import errorPopup from '../reducers/error-popup'
import tours from '../reducers/tours'
import lists from '../reducers/lists'
import networkOperations from '../reducers/network-icon'

export default combineReducers({
  login,
  errorPopup,
  networkOperations,
  tours,
  lists
})
