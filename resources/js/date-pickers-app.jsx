import { createRoot } from "react-dom/client";
import DatePickers from "./components/DatePickers.jsx";

const mount = document.getElementById("react-date-pickers");
if (mount) {
    createRoot(mount).render(<DatePickers />);
}
