import axios from "axios"
import { global } from "./GlobalUrl";

export const instance = axios.create({
    baseURL: global.url,
    headers: {'Content-Type': 'application/json'}
  });
