// Import JS Files
// Classes
import Log from './javascript/classes/log'

// Add Styling to the project
import 'bootstrap'

// Add custom SCSS
require('./scss/styles.scss')

const myLog = new Log()

myLog.writeLog()
