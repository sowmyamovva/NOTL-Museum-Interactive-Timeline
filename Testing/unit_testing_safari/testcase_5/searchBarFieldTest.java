package testcase_5;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.safari.SafariDriver;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class searchBarFieldTest {
    WebDriver driver = null;

    @BeforeEach
    public void beforeAll() {
        driver = new SafariDriver();
        driver.navigate().to("https://badger-timeline.infinityfreeapp.com/public_html/");
    }


    @AfterEach
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
        WebElement element = driver.findElement(By.xpath("/html/body/nav/div/ul[2]/div/form/input"));
        element.sendKeys("put me in coach");
    }

    public static void main (String[] args){

    }
}
